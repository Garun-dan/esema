<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#83bc3c">
    <!-- Tab Icon -->
    <link rel="shortcut icon" href="<?= base_url('assets/upload/logo/' . $getMaintenance->favicon); ?>" type="image/x-icon" />
    <title><?= $getMaintenance->nama_website; ?> | <?= $judul; ?></title>

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/'); ?>plugin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugin/bootstrap/icon/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugin/alert/sweetalert2.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/plugin/tabel/'); ?>datatables.min.css">


    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>tema/admin/admin.css" />
    <link rel="manifest" href="<?= base_url('assets/manifest.json'); ?>" />

    <!-- Custom JS -->
    <script src="<?= base_url('assets/plugin/handsontable/'); ?>handsontable.full.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/plugin/handsontable/'); ?>handsontable.full.min.css">
    <script src="<?= base_url('assets/'); ?>plugin/jquery/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div id="success" data-success="<?= $this->session->flashdata('success'); ?>"></div>
    <div id="error" data-error="<?= $this->session->flashdata('error'); ?>"></div>
    <div id="warning" data-warning="<?= $this->session->flashdata('warning'); ?>"></div>
    <div class="container-fluid">