
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>UUC | Admission</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
        @import url("https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap");
        body {
            background: #f9f9f9;
            font-family: "Roboto", sans-serif;
        }

        .main-content {
            padding-top: 100px;
            padding-bottom: 100px;
        }

        .info-card {
            background: #fff;
            text-align: center;
            padding: 50px 30px;
            margin-bottom: 30px;
            border-radius: 3px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .info-card .info-card_icon {
            height: 125px;
            width: 125px;
            margin: 0 auto 50px auto;
            border: 5px solid #4caf50;
            border-radius: 125px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .info-card .info-card_icon i {
            font-size: 50px;
            color: #4caf50;
        }
        .info-card .info-card_icon .info-card_img-icon {
            height: 60px;
            width: 60px;
            object-fit: contain;
        }
        .info-card .info-card_label {
            margin-bottom: 15px;
        }
        .info-card .info-card_message {
            margin-bottom: 15px;
        }
        .info-card .btn {
            background: #03a9f4;
            border-color: #03a9f4;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        .info-card--success .info-card_icon {
            border-color: #4caf50;
        }
        .info-card--success .info-card_icon i {
            color: #4caf50;
        }
        .info-card--danger .info-card_icon {
            border-color: #f44336;
        }
        .info-card--danger .info-card_icon i {
            color: #f44336;
        }
        .info-card--warning .info-card_icon {
            border-color: #ff9800;
        }
        .info-card--warning .info-card_icon i {
            color: #ff9800;
        }
        svg#Capa_1 {max-width: 75%;}
    </style>
</head>
<body>
	<section class="main-content">
		<div class="container">
			<br>
			<br>
			<div class="row">
				<div class="col-sm-6 col-md-12 text-center">
					<div class="info-card info-card--success">
						<div class="info-card_icon">

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 426.667 426.667" style="enable-background:new 0 0 426.667 426.667;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path fill="#4caf50" d="M421.876,56.307c-6.548-6.78-17.352-6.968-24.132-0.42c-0.142,0.137-0.282,0.277-0.42,0.42L119.257,334.375    l-90.334-90.334c-6.78-6.548-17.584-6.36-24.132,0.42c-6.388,6.614-6.388,17.099,0,23.713l102.4,102.4    c6.665,6.663,17.468,6.663,24.132,0L421.456,80.44C428.236,73.891,428.424,63.087,421.876,56.307z"/>
                                    </g>
                                </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                            </svg>
						</div>
						<h2 class="info-card_label">Successful</h2>
						<div class="info-card_message"><span style="text-decoration: underline;font-weight:bold;color:#03a9f4">{{ $hash->name }}</span>, you have successfully applied for admission in UUC with application no. <span style="text-decoration: underline;font-weight:bold;color:#03a9f4">{{ $hash->application_no }}</span>. Please wait you will be notified futher in your given email if any progress made in your admission process.</div>
						<a  href="{{ route('login') }}" class="btn btn-primary">Go to Back</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
