<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>{{ $title ?? 'Klik Survei' }}</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    body {
        background-color: #F0F1F4;
        margin-top: 0;
    }

    button.btn:hover {
        color: #6f6d6d;
        background-color: #00000017;
        border-color: lightgrey;
    }

    .header-hr{
        border-top: 4px solid #7d7d7d;
        margin-bottom: 15px;
    }

    .container.bg-light{
        max-width: 1080px;
    }

    .first-color {
        color: #0C93BF;
    }

    .second-color {
        color: #656464;
    }

    .italic {
        font-style: italic;
    }

    .header-body {
        border-left: 4px solid #0C93BF;
        padding-left: 10px;
        padding-bottom: 2px;
    }

    .dynamic input.form-control {
        border: none;
        border-bottom: 1px solid #ced4da;
    }

    label.required::after {
        content: "*";
        width: 1.5em;
        margin-right: 1.5em;
        margin-left: 5px;
        color: red;
        font-weight: 600;
    }

    label+input:not([required]) {
        box-shadow: -3.2em 0 0 #fff;
    }

    .img-question img {
        height: 250px;
        width: auto;
    }

    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .btn.upload {
        border: none;
        color: gray;
        background-color: white;
        padding: 8px 20px;
        cursor: pointer;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
    }

    .btn.upload i {
        font-size: 48px
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        cursor: pointer;
        left: 0;
        top: 0;
        opacity: 0;
    }

    .stepper{
        position: sticky !important;
        top: 0;
        left: 0;
        right: 0;
        z-index: 999;
    }

    .stepwizard-step p {
        margin-top: 10px;
    }

    .stepwizard-row {
        /* display: table-row; */
        justify-content: center;
    }

    .stepwizard {
        /* display: table; */
        justify-content: center;
        width: 100%;
        position: relative;
    }

    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }

    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }

    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }

    .btn-primary-fill{
        background-color: #0C93BF;
        color: #fff;
        font-weight: 800;
    }

    .btn-secondary-fill{
        background-color: #dadada;
        color: #fff;
        font-weight: 800;
    }

    .btn-primary-next{
        background-color: #18a6d5;
        color: #fff;
    }

    .displayNone {
        display: none;
    }

</style>
