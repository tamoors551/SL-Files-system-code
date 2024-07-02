<?php  include("./constants/db_config.php");
include("./constants/values.php");


if(isset($_POST['submit']))
{
    
    $cell = $cell; 
    $Experience=$_POST['experience'];
    $Job_Status = $_POST['jobtype'];
     $Job_Statusd = mb_convert_case($Job_Status, MB_CASE_UPPER, 'UTF-8'); 
    $Country=$_POST['country']; 
    $City=$_POST['city']; 
    $Salary_range=$_POST['Salary_range']; 
    if (isset($_POST['currency'])) {
        $currency = $_POST['currency']; // Get the selected currency value from the form
        
        // Concatenate currency symbol with the salary range
        $Salary_range = $currency . ' ' . $Salary_range; // For example: "5000 USD"
     
    }
    $Education=$_POST['Education']; 
    $Profession=$_POST['Profession']; 
    $Timing=$_POST['Timing']; 
    $Job_title=$_POST['Job_title']; 
    $Apply_before=$_POST['Apply']; 
    $Company_name=$_POST['Company_name']; 
    $login = '0302';
    //for getting product id
    $Date_time = date("d-m-y"); 

       $query="INSERT INTO `jobs`(`title`, `company`, `profession`, `Salary`, `experience`,`Apply_before`, `education`, `adress`, `timing`, `status`, `created_on`, `updated_on`, `deleted_on`,`cell`) VALUES ('$Job_title','$Company_name','$Profession', '$Salary_range','$Experience','$Apply_before','$Education','$City','$Timing','$Job_Statusd','$Date_time','$Date_time','$Date_time','$cell')";
    

    if(mysqli_query($con, $query))
    {  
        $last_id = mysqli_insert_id($con);

        $directory = "Data/";
        if (!is_dir($directory)) {
            mkdir($directory);
        }	
        $directory = "Data/Files/";
        if (!is_dir($directory)) {
            mkdir($directory);
        }
        $directory = "Data/Vednor/";
        if (!is_dir($directory)) {
            mkdir($directory);
        }

        $fileName = "Data/Files/$last_id.txt";
        $myFile = fopen($fileName, "w") or die("Unable to open file"); 
        $txt = $Job_title . "~@~" . $Salary_range . "~@~" . $Education . "~@~" . $City . "~@~" . $Experience . "~@~" . $cell . "~@~" . $Timing . "\n";
        fwrite($myFile, $txt);
        fclose($myFile);

        $fileName1 = "Data/Vednor/$cell.txt";
        $myFile1 = fopen($fileName1, "w") or die("Unable to open file");
        $txt1 = $last_id.".txt";
        fwrite($myFile1, $txt1);
        fclose($myFile1);
  

    }
    else
    {
        echo "not done sucessfully";
    } 
} 
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Green Jobs</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="./css/first_link.css" rel="stylesheet">
    <link href="./css/second_link.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="manifest" href="./css/ionicons.min.css">
    <link rel="stylesheet" href="./css/sweetalert.css">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="./"><img src="./img/greenapp.png" alt="Logo" style="height: 50px;" /></a>

            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link ">Home</a>
                    <a href="add_job.php" class="nav-item nav-link">Add job</a>
                    <?php 
                        $ret = mysqli_query($con, "SELECT * FROM `resume` where `phone` = '$cell'");
                             $row = mysqli_fetch_array($ret); 
                        if($row) {
                    ?>
                    <a href="resume.php" class="nav-item nav-link">view resume</a>
                    <?php  } else { ?>
                    <a href="add_Cv.php" class="nav-item nav-link">Add resume</a>
                    <?php } ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Jobs</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="company_jobs.php" class="dropdown-item active">Your Jobs</a>
                            <a href="applied_jobs.php" class="dropdown-item ">Applied Jobs</a>
                        </div>
                        <a href="https://eduvalley.pk/greenApp" class="nav-item nav-link ">Go to green app</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Header End -->



        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="mb-3">
                    <form class="post-form-wrapper" method="POST" autocomplete="off">
                        <label class="form-label">Company name</label>
                        <input type="text" class="form-control" id="Company_name" name="Company_name"
                            placeholder="Enter your company name" oninput = "this.value = this.value.replace(/[^A-Za-z]/g, '')">
                </div>
                <div class="mb-3">
                    <label class="form-label">Designation</label>
                    <input type="text" class="form-control" name="Job_title" id="Job_title" placeholder="Title for your job" oninput = "this.value = this.value.replace(/[^A-Za-z]/g, '')">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Job Type:</label>
                        <select name="jobtype" id="jobtype" class="selectpicker show-tick form-control" data-live-search="false"
                            data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK"
                            data-none-selected-text="All">
                            <option value="" selected>Select</option>
                            <option value="On site" data-content="<span class='label label-danger'>Part-time</span>">On
                                site</option>
                            <option value="Remote" data-content="<span class='label label-success'>Freelance</span>">
                                Remote</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Job start Time </label>
                    <input type="time" name="Timing" id="Timing" class="form-control" placeholder="Timing">
                </div> 
                <div class="mb-3">
                    <label class="form-label"> Job end Time </label>
                    <input type="text" name="Timing" id="Timing" class="form-control" placeholder="Timing">
                </div> 
                <div class="mb-3 input-group">
                    <input type="number"  name="Salary_range" class="form-control" id="Salary_range" placeholder="Salary">
                    <div class="input-group-append">
                        <select class="form-select" name="currency">
                            <option value="PKR">PKR</option>
                            <option value="USD">USD</option>
                            <option value="INR">INR</option>
                            <option value="Pound">Pound</option>
                            <option value="Daharam">Daharam</option>
                            <option value="Rayal">Rayal</option>
                            <!-- Add more currency options as needed -->
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Education required</label>
                    <input type="text" name="Education" id="Education" class="form-control" placeholder="Education" oninput = "this.value = this.value.replace(/[^A-Za-z]/g, '')">
                </div>
                 
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Experience Required:</label>
                        <select name="experience" id="experience" class="selectpicker show-tick form-control" data-live-search="false"
                            data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK"
                            data-none-selected-text="All">
                            <option value="None" selected>None</option>
                            <option value="1 Years">1 Years</option>
                            <option value="2 Years">2 Years</option>
                            <option value="3 Years">3 Years</option>
                            <option value="4 Years">4 Years</option>
                            <option value="5 Years">5 Years</option>
                            <option value="10 Years">10 Years</option>
                        </select>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>You Are searching for a</label>
                        <select name="Profession" required class="selectpicker show-tick form-control"
                            data-live-search="false" data-selected-text-format="count > 3" data-done-button="true"
                            data-done-button-text="OK" data-none-selected-text="All">
                            <option value="None">None</option>
                            <option value="Developer">Developer</option>
                            <option value="Peon">Peon</option>
                            <option value="Normal_worker">Normal worker</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Engineer">Engineer</option>
                        </select>
                    </div> 
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Country</label>
                        <select name="country" id="country" class="selectpicker show-tick form-control" data-live-search="true">
                            <option disabled value="">Select</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="India">India</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Australia">Australia</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Location</label>
                            <input name="city" id="city" type="text" class="form-control" placeholder="Enter Address">
                        </div>
                    </div>

                </div>
                <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Apply before</label>
                            <!-- Input field transformed into a calendar input -->
                            <div class="form-group">
                                <input type="date" name="Apply" id="datepicker" class="form-control"
                                    value="<?php echo date('Y-m-d'); ?>" placeholder="Select date" min="<?php echo date('Y-m-d'); ?>">
                            </div> 
                        </div>
                    </div>

                <!-- <div class="col-sm-6">
                    <input type="button" name="submit1" data-bs-toggle="modal"
                        data-bs-target="#mpinActionSheetForm" value="Add a Job" class="btn btn-primary btn-lg"> 
                </div> -->
                <div class="col-sm-6">
				<button type="submit" name="submit" class="btn btn-primary btn-lg">Add
					Your Job</button>
			</div>
                </form>
            </div>
        </div>
        <!-- About End -->  

        <!-- MPIN Form Action Sheet -->
        <div class="modal fade modalbox" id="mpinActionSheetForm" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background-color: #00B074;">
                    <div >
                        <a href="javascript:;" data-bs-dismiss="modal" class="headerButton ">
                            <ion-icon name="chevron-back-outline"></ion-icon>
                        </a> 
                    </div>
                    <h3 class="mx:auto" style=" color: white; margin-left: 40px;">Choose payment method</h3> 
                    <br>
                    <div class="text" id="appendErrorResponseMpin"
                        style="color:red; text-align: center; font-weight: bold; text-transform: uppercase;"> 
                    </div>
                    
                    <div class="modal-body">
                        <div class="action-sheet-content"> 
                            <button type="button"  data-bs-toggle="modal"
                            data-bs-target="#selected" class="btn btn-dark btn-lg" style="width: 100%;">
                                GreenApp
                                <img src="./img/green2.png" style="width: 20px; margin-left: 5px;" alt="">
                            </button>
                        </div>
                        <div class="form-group basic mt-3">
                            <button type="button"  data-bs-toggle="modal"
                            data-bs-target="#Jazzcash" class="btn btn-dark btn-lg" style="width: 100%;">
                                Jazzcash
                                <img src="./img/jazzcash.webp" style="width: 40px; margin-left: 5px;" alt="">
                            </button>
                        </div> 
                        <div class="action-sheet-content "> 
                            <button type="button"  data-bs-toggle="modal"
                            data-bs-target="#EasyPaisa" class="btn btn-dark btn-lg" style="width: 100%;">
                                EasyPaisa
                                <img src="./img/easypaisa.png" style="width: 25px; margin-left: 5px;" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
              <!----------------------------------------------------------- GreenPay ---------------------------------------------------------------------------->

        <div class="modal fade modalbox" id="selected" tabindex="-1" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div >
                        <a href="javascript:;" data-bs-dismiss="modal" class="headerButton ">
                            <ion-icon name="chevron-back-outline"></ion-icon>
                        </a> 
                    </div>
                    <button type="button" class="btn btn-" style="background-color: #00B074; color: white;" data-bs-dismiss="modal">Close</button>
                    <br>
                    <div class="text" id="appendErrorResponseMpin"
                        style="color:red; text-align: center; font-weight: bold; text-transform: uppercase;">

                    </div>
                    
                    <div class="modal-body" style="height: 750px;">
                        <div class="action-sheet-content">
                            <div class="form-group basic">
                                <input type="password" class="form-control" name="password" autocomplete="off"
                                    placeholder="Enter Your Green MPIN" id="login__text1" 
                                    maxlength="4">
                            </div>
                        <details>
                            <summary>More about greenPay</summary>
                            <pre><span style="font-size: 20px; color: black;">Convenience:</span> 
"Using <span style="color: black;">"<u>Jazzcash</u>"</span> is so convenient.
 It's great to have a payment method 
 that is easily accessible and
  user-friendly."

 <span style="font-size: 20px; color: black">Versatility:</span>                              
"The versatility of <span style="color: black;">"<u>Jazzcash</u>"</span> is 
impressive. Whether I'm paying bills,
transferring money, or making 
purchases,  it's always reliable."

 <span style="font-size: 20px; color: black">Secure Transactions:</span>                           
"I feel secure using <span style="color: black;">"<u>Jazzcash</u>"</span> for my
 transactions. The robust security 
measures give me confidence in making
 digital payments."</pre>
                        </details>
                            <div class="form-group basic mt-3">
                                <a class="btn btn-primary btn-block btn-lg" name="submit">Pay: 50Rs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <!----------------------------------------------------------- Jazzcash ---------------------------------------------------------------------------->
        <div class="modal fade modalbox" id="Jazzcash" tabindex="-1" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div >
                        <a href="javascript:;" data-bs-dismiss="modal" class="headerButton ">
                            <ion-icon name="chevron-back-outline"></ion-icon>
                        </a> 
                    </div>
                    <button type="button" class="btn btn-" style="background-color: #00B074; color: white;" data-bs-dismiss="modal">Close</button>
                    <br>
                    <div class="text" id="appendErrorResponseMpin"
                        style="color:red; text-align: center; font-weight: bold; text-transform: uppercase;"> 
                    </div>

                    <input type="hidden" id="type" value="Jazzcash">

                    <div class="modal-body" style="height: 750px;">
                        <div class="action-sheet-content">
                            <!-- <div class="form-group basic">
                                <input type="number" class="form-control" id="number" name="number" autocomplete="off"
                                    placeholder="Enter Your Jazzcash number" 
                                    maxlength="4">
                            </div>
                                <input type="number" class="form-control" id="cnic" name="cnic" autocomplete="off"
                                    placeholder="Enter Your Cnic"  
                                    maxlength="4">
                                <input type="number" class="form-control mt-3" id="Mpin" name="Mpin" autocomplete="off"
                                    placeholder="Enter Your Mpin"  
                                    maxlength="4">
                            </div> -->
                        <details>
                            <summary>More about Jazzcash</summary>
                            <pre><span style="font-size: 20px; color: black;">Convenience:</span> 
"Using <span style="color: black;">"<u>Jazzcash</u>"</span> is so convenient.
 It's great to have a payment method 
 that is easily accessible and
  user-friendly."

 <span style="font-size: 20px; color: black">Versatility:</span>                              
"The versatility of <span style="color: black;">"<u>Jazzcash</u>"</span> is 
impressive. Whether I'm paying bills,
transferring money, or making 
purchases,  it's always reliable."

 <span style="font-size: 20px; color: black">Secure Transactions:</span>                           
"I feel secure using <span style="color: black;">"<u>Jazzcash</u>"</span> for my
 transactions. The robust security 
measures give me confidence in making
 digital payments."</pre>
                        </details>
                            <div class="form-group basic mt-3">
                                <a class="btn btn-primary btn-block btn-lg" name="submit">Pay: 50Rs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!----------------------------------------------------------- EasyPaisa ---------------------------------------------------------------------------->
        <div class="modal fade modalbox" id="EasyPaisa" tabindex="-1" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div >
                        <a href="javascript:;" data-bs-dismiss="modal" class="headerButton ">
                            <ion-icon name="chevron-back-outline"></ion-icon>
                        </a> 
                    </div>
                    <button type="button" class="btn btn-" style="background-color: #00B074; color: white;" data-bs-dismiss="modal">Close</button>
                    <br>
                    <div class="text" id="appendErrorResponseMpin"
                        style="color:red; text-align: center; font-weight: bold; text-transform: uppercase;">

                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <div class="form-group basic">
                                <input type="number" class="form-control" name="number" autocomplete="off"
                                    placeholder="Enter Your EasyPaisa number" id="login__text1" 
                                    maxlength="4">
                            </div> 
                            <input type="hidden" id="type" value="EasyPaisa">
                            <div class="form-group basic">
                                <input type="number" class="form-control" name="Mpin" autocomplete="off"
                                    placeholder="Enter Your EasyPaisa Mpin" id="login__text1" 
                                    maxlength="4">
                            </div> 
                        <details class="mt-3">
                            <summary>More about EasyPaisa</summary>
                            <pre><span style="font-size: 20px; color: black;">Convenience:</span> 
"Using <span style="color: black;">"<u>EasyPaisa</u>"</span> is so convenient. 
It's great to have a payment method
 that is easily accessible and user-friendly."

 <span style="font-size: 20px; color: black">Versatility:</span>                              
"The versatility of <span style="color: black;">"<u>EasyPaisa</u>"</span> is impressive. Whether I'm
 paying bills, transferring money, or making purchases,
  it's always reliable."

 <span style="font-size: 20px; color: black">Secure Transactions:</span>                           
"I feel secure using <span style="color: black;">"<u>EasyPaisa</u>"</span> for my transactions.
 The robust security measures give me confidence in
  making digital payments."</pre>
                        </details>
                            <div class="form-group basic mt-3">
                                <a class="btn btn-primary btn-block btn-lg" name="submit" >Pay: 50Rs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- JavaScript Libraries -->
        <script src="./css/code.jquery.com_jquery-3.4.1.min.js"></script>
        <script src="./css/cdn.jsdelivr.net_npm_bootstrap@5.0.0_dist_js_bootstrap.bundle.min.js"></script>
         <!-- Splide -->
        <script src="./js/splide.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="./js/sweetalert.min.js"></script>
        <script src="./js/ionicons.js"></script> 
        <!--  link of sweetalerts --> 
        <script src="./js/sweetalert.js"></script>
        <script src="./js/sweetalert.min.js"></script>
        
 

<!-- <script src="./js/base.js"></script> -->
<!-- Template Javascript -->
        <script src="js/main.js"></script>
</body>

</html>