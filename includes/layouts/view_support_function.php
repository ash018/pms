<?php
function prescriptionCreateHeader($pagename){
    return '<head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>'.$pagename.'</title>

        <!-- Favicon-->
        <link rel="icon" href="../../assets/BSBTheme/favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="../../assets/BSBTheme/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="../../assets/BSBTheme/plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="../../assets/BSBTheme/plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Sweet Alert Css -->
        <link href="../../assets/BSBTheme/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

        <!-- Colorpicker Css -->
        <link href="../../assets/BSBTheme/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />

        <!-- Dropzone Css -->
        <link href="../../assets/BSBTheme/plugins/dropzone/dropzone.css" rel="stylesheet">

        <!-- Multi Select Css -->
        <link href="../../assets/BSBTheme/plugins/multi-select/css/multi-select.css" rel="stylesheet">

        <!-- Bootstrap Spinner Css -->
        <link href="../../assets/BSBTheme/plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

        <!-- Bootstrap Tagsinput Css -->
        <link href="../../assets/BSBTheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

        <!-- Bootstrap Select Css -->
        <link href="../../assets/BSBTheme/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

        <!-- noUISlider Css -->
        <link href="../../assets/BSBTheme/plugins/nouislider/nouislider.min.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="../../assets/BSBTheme/css/style.css" rel="stylesheet">

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="../../assets/BSBTheme/css/themes/all-themes.css" rel="stylesheet" />

        <style>
            
            .editableTableInput{
                position: absolute;
                top: 64.15px;
                left: 452px; 
                text-align: start;
                width: 76px;
                height: 42px; 
                padding: 10px; 
                font-size: 14px; 
                font-family: "Roboto",Arial,Tahoma,sans-serif; 
                font-weight: 400;
/*                display: none;*/
            }

            .container {
                margin-top: 25px;
            }
            .form-inline .form-group > div.col-xs-8 {
                padding-left: 0;
                padding-right: 0;
            }
            .form-inline label {
                line-height: 34px;
            }
            .form-inline .form-control {
                width: 100%;
            }
            @media (min-width: 768px) {
                .form-inline .form-group {
                    margin-bottom: 15px;
                }
            }


            .ui-autocomplete-input{
                z-index:5000;
            }
            label, input { display:block;  }
            input.text { margin-bottom:12px; width:95%; padding: .4em;}
            fieldset { padding:0; border:0; margin-top:25px; }
            h1 { font-size: 1.2em; margin: .6em 0; }
            div#users-contain { width: 350px; margin: 20px 0; }
            div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
            div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
            .ui-dialog .ui-state-error { padding: .3em; }
            .validateTips { border: 1px solid transparent; padding: 0.3em; }


            .nopadding {
                padding: 0 !important;
                margin: 4px !important;
            } 

        </style>
        <style>
            .panel-primary .panel-heading {
                color: #000;
                background-color: #F0F0F0;
                border-color: #258cd1;
            }
        </style>
        <style>
            /*     .container input[type=text] {
                    padding:3px 0px;       
                    margin:5px 5px 5px 0px;
                    display: inline-block;
                }*/
            .container1 input[type=text] {
                padding:5px 0px;
                margin:5px 5px 5px 0px;
                display: inline-block;
            }
            .container2 input[type=text] {
                padding:5px 0px;
                margin:5px 5px 5px 0px;
                display: inline-block;
            }

            .container3 input[type=text] {
                padding:5px 0px;
                margin:5px 5px 5px 0px;
                display: inline-block;
            }


            .add_form_field
            {
                background-color: #1c97f3;
                border: none;
                color: white;
                padding: 8px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 12px;
                margin: 4px 2px;
                cursor: pointer;
                border:1px solid #186dad;

            }

            .delete{
                background-color: #fd1200;
                border: none;
                color: white;
                padding: 5px 15px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 14px;
                margin: 4px 2px;
                cursor: pointer;

            }



            .resizing-input input, .resizing-input span {
                font-size: 12px;
                font-family: Sans-serif;
                white-space: pre;
                padding: 5px;
            }

        </style>
    </head>';
}


function attachedHeader($headerName) {
    return '<head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>' . $headerName . '</title>

        <!-- Favicon-->
        <link rel="icon" href="../../assets/BSBTheme/favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="../../assets/BSBTheme/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="../../assets/BSBTheme/plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="../../assets/BSBTheme/plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Sweet Alert Css -->
        <link href="../../assets/BSBTheme/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

        <!-- Colorpicker Css -->
        <link href="../../assets/BSBTheme/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />

        <!-- Dropzone Css -->
        <link href="../../assets/BSBTheme/plugins/dropzone/dropzone.css" rel="stylesheet">

        <!-- Multi Select Css -->
        <link href="../../assets/BSBTheme/plugins/multi-select/css/multi-select.css" rel="stylesheet">

        <!-- Bootstrap Spinner Css -->
        <link href="../../assets/BSBTheme/plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

        <!-- Bootstrap Tagsinput Css -->
        <link href="../../assets/BSBTheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

        <!-- Bootstrap Select Css -->
        <link href="../../assets/BSBTheme/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

        <!-- noUISlider Css -->
        <link href="../../assets/BSBTheme/plugins/nouislider/nouislider.min.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="../../assets/BSBTheme/css/style.css" rel="stylesheet">

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="../../assets/BSBTheme/css/themes/all-themes.css" rel="stylesheet" />
    </head>';
}

?>
