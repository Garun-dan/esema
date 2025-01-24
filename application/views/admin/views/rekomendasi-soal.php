<?php
date_default_timezone_set('Asia/Jakarta');
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
?>

<?php foreach ($getTNA as $tna) { ?>
  <div class="collapse" id="prev_soal<?= $tna->id_tna; ?>">
    <div class="box">
      <h4 class="mb-3"><b><?= $tna->judul_tna; ?></b></h4>
      <div class="form-group mb-3">
        <label for="jenis_soal<?= $tna->id_tna; ?>">Jenis Soal</label>
        <select name="jenis_soal<?= $tna->id_tna; ?>" id="jenis_soal<?= $tna->id_tna; ?>" class="form-control jenis_soal">
          <option selected disabled>Pilih Jenis Soal</option>
          <option value="pertanyaan">Pertanyaan</option>
          <option value="pernyataan">Pernyataan</option>
        </select>
      </div>
      <div id="rekom<?= $tna->id_tna; ?>"></div>
      <div class="mt-3 text-center">
        <button type="button" id="reload_halaman" class="tbl-info" onclick="onReload('<?= $tna->id_tna; ?>')">Reload Halaman</button>
      </div>
    </div>
  </div>
<?php } ?>

<script>
  $(document).ready(function() {
    $(".jenis_soal").change(function() {
      var id_tna = $(this)
        .closest(".collapse")
        .attr("id")
        .replace("prev_soal", "");
      var jenis_soal = $(this).val();

      $.ajax({
        url: "<?= base_url('admin/tna/data-tna/preview-soal'); ?>",
        type: "POST",
        data: {
          id_tna: id_tna,
          jenis_soal: jenis_soal,
        },
        success: function(responseData) {
          console.log(responseData);
          var result = JSON.parse(responseData);
          var rekomendasi = {};

          result.forEach(function(item) {
            var parts = item.split(" | ");
            var instrumen = parts[0];
            var tingkat = parts[1].split(": ")[1];

            if (!rekomendasi[instrumen]) {
              rekomendasi[instrumen] = {};
            }

            var pertanyaan = item.split(": ")[1];
            if (!rekomendasi[instrumen][tingkat]) {
              rekomendasi[instrumen][tingkat] = [];
            }
            rekomendasi[instrumen][tingkat].push(pertanyaan);
          });

          var htmlContent = "";
          for (var instrumen in rekomendasi) {
            htmlContent += "<h3>" + instrumen + "</h3>";
            var itrData = instrumen.substring(instrumen.indexOf("itr"));
            for (var tingkat in rekomendasi[instrumen]) {
              var tingkatText = tingkat.match(/(Sulit|Penting|Sering)/)[0];
              var pertanyaan = rekomendasi[instrumen][tingkat].join("\n");
              var textareaName =
                "soal_" + itrData + "_" + tingkatText.toLowerCase();
              htmlContent += "<p>" + tingkatText + "</p>";
              htmlContent +=
                '<textarea name="' +
                textareaName +
                '[]" rows="5" cols="10" class="form-control">' +
                pertanyaan +
                "</textarea><br><br>";
            }
            if (instrumen.includes("itr")) {
              var itrText = instrumen.substring(instrumen.indexOf("itr"));
              var buttonId = "simpan_" + itrText;
              htmlContent +=
                '<button id="' +
                buttonId +
                '" class="tbl-primer float-right" onclick="saveData(\'' +
                id_tna +
                "', '" +
                itrText +
                "')\">Simpan Data</button><br><br>";
            }
          }
          $("#rekom" + id_tna).html(htmlContent);
        },
        error: function(xhr, status, error) {
          console.error(
            "Terjadi kesalahan saat melakukan permintaan Ajax:",
            error
          );
        },
      });
    });
  });

  function saveData(id_tna, itrText) {
    var sulitValues = document.querySelectorAll(
      'textarea[name="soal_' + itrText + '_sulit[]"]'
    );
    var pentingValues = document.querySelectorAll(
      'textarea[name="soal_' + itrText + '_penting[]"]'
    );
    var seringValues = document.querySelectorAll(
      'textarea[name="soal_' + itrText + '_sering[]"]'
    );

    var sulitTexts = [];
    var pentingTexts = [];
    var seringTexts = [];

    sulitValues.forEach(function(textarea) {
      sulitTexts.push(textarea.value);
    });

    pentingValues.forEach(function(textarea) {
      pentingTexts.push(textarea.value);
    });

    seringValues.forEach(function(textarea) {
      seringTexts.push(textarea.value);
    });

    $.ajax({
      url: "<?= base_url('admin/tna/data-tna/simpan-soal/'); ?>" + itrText,
      type: "POST",
      data: {
        id_tna: id_tna,
        itrText: itrText,
        sulitTexts: sulitTexts,
        pentingTexts: pentingTexts,
        seringTexts: seringTexts,
      },
      success: function(response) {
        var sulitElements = document.querySelectorAll(
          'textarea[name="soal_' + itrText + '_sulit[]"]'
        );
        var pentingElements = document.querySelectorAll(
          'textarea[name="soal_' + itrText + '_penting[]"]'
        );
        var seringElements = document.querySelectorAll(
          'textarea[name="soal_' + itrText + '_sering[]"]'
        );
        sulitElements.forEach(function(element) {
          element.style.display = "none";
        });

        pentingElements.forEach(function(element) {
          element.style.display = "none";
        });

        seringElements.forEach(function(element) {
          element.style.display = "none";
        });
      },
      error: function(xhr, status, error) {
        console.error("Terjadi kesalahan saat menyimpan data:", error);
      },
    });
  }

  function onReload(id_tna) {
    $.ajax({
      url: "<?= base_url('admin/tna/data-tna/reload-data'); ?>",
      type: "POST",
      data: {
        id_tna: id_tna,
        status: "Aktif",
      },
      success: function(response) {
        console.log("Data berhasil disimpan.");
        window.location.href = "<?= base_url('admin/tna/data-tna'); ?>";
      },
      error: function(xhr, status, error) {
        console.error("Terjadi kesalahan saat menyimpan data:", error);
      },
    });
  }
</script>