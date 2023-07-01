<!Doctype html>
<html>

<head>
    <title></title>
    <style>
        .pdf_head,
        .pdf_footer {
            display: -webkit-box;
            display: flex;
            -webkit-box-pack: space-between;
            justify-content: space-between;
            align-items: center;
        }

        .Pdf_wrapper {
            border: 3px double #811616;
            padding: 15px;
        }

        .pdf_txt {
            margin: 40px 0px;
        }

        img{max-width: 100%;}

        .col-sm-1,
            .col-sm-2,
            .col-sm-3,
            .col-sm-4,
            .col-sm-5,
            .col-sm-6,
            .col-sm-7,
            .col-sm-8,
            .col-sm-9,
            .col-sm-10,
            .col-sm-11,
            .col-sm-12 {
                float: left;
                padding: 0;
            }

            .col-sm-12 {
                width: 100%;
            }

            .col-sm-11 {
                width: 91.66666667%;
            }

            .col-sm-10 {
                width: 83.33333333%;
            }

            .col-sm-9 {
                width: 75%;
            }

            .col-sm-8 {
                width: 66.66666667%;
            }

            .col-sm-7 {
                width: 58.33333333%;
            }

            .col-sm-6 {
                width: 50%;
            }

            .col-sm-5 {
                width: 41.66666667%;
            }

            .col-sm-4 {
                width: 33.33333333%;
            }

            .col-sm-3 {
                width: 25%;
            }

            .col-sm-2 {
                width: 16.66666667%;
            }

            .col-sm-1 {
                width: 8.33333333%;
            }


        

        /* @page {
            size: auto;
            margin: 0;
        } */
    </style>
</head>

<body>

    <div class="Pdf_wrapper">
        <div class="pdf_head">
            <div class="col-sm-3">
                <img src="backend/img/favicon/logo.jpg">
            </div>
            <div class="col-sm-6" style="text-align:center; ">
                <h2 style="font-size: 12pt; margin-bottom: 0; padding-bottom:0; line-height: 0px;">UTKAL UNIVERSITY OF CULTURE</h2>
                <h5 style="font-size: 9pt; margin-bottom: 0; padding-bottom:0; line-height: 0px;">REGISRTATION RECEIPT</h5>
            </div>
            <div class="col-sm-3">
                <img src="backend/img/barcode.png" alt="" style="max-width: 80%; text-align: right;">
            </div>
            <div style="clear: both;"></div>
        </div>
        
        <div class="pdf_txt">
            <div class="col-sm-12">
                <p style="line-height: 25px; text-align: justify; font-size: 9pt;">
                    Mr./Ms. <b>{{ $name }}</b> of <b>{{ $clg }}</b>, <b>{{ $city }}</b> has been
                    enrolled as
                    student of utkal university of Culture, Madanpur, Bhubaneswar for Bachelor of Performing Art Programme
                    for the session {{ $session_yr }}, His/Her Registration Number is <b>{{ $reg_no }}</b>.
                </p>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div class="pdf_footer">
           
                <div class="col-sm-6" style="text-align: left;">
                    <i><b style=" font-size: 7pt;">Ink Signature of the Principal / Chairman, P.G.Council, UUC With Seal</b></i>
                </div>
                
           
           
                <div class="col-sm-6" style="text-align: right;">
                    <b><i style="font-size: 7pt;">Controller Of Examination</i></b>
                </div>
                <div style="clear: both;"></div>
            
        </div>
    </div>

</body>

</html>
