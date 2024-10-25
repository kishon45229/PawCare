<!DOCTYPE html>
<html>
    <head>
        <title>Take care of your pets - PawCare</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <style>
            body,html {
                height: 100%;
                margin: 0;
            }

            html {
                scroll-behavior: smooth;
            }

            .menu {
                text-align: center;
                background-color: white;
                overflow: hidden;
                border-bottom: 2px solid #245953;
            }
	
            .menu a {
                float: left;
                color: black;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
                font-weight: 500;
            }
        
            .menu a:hover {
                color: black;
                transform: scale(1.2);
            }
        
            .menu a.active {
                background-color: #245953;
                color: white;
            }

            .menu .login button{
                float: right;
                height: 40px;
                width: 90px;
                margin-top: 5px;
                margin-right: 15px;
                background-color: #245953;
                border: none;
                border-radius: 30px;
                text-align: center;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 16px;
                font-weight: 500;
                color: #fff;
            }

            .menu button:hover {
                color: #fff;
                transform: scale(1.05);
                cursor: pointer;
            }

            section {
                position: relative;
                width: 100%;
                height: 100%;
                display: flex;  
            }

            section .textBox {
                width: 60%;
                height: 100%; 
                margin: auto;
            }

            section .imgBox {
                width: 50%;
                height: 100%;
            }

            .websiteName {
                margin: auto;
                text-align: center;
                font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                font-size: 100pt;
                font-weight: 600;
                padding-top: 20px; 
                color: #245953;
            } 

            .subHeadingText {
                margin: auto;
                text-align: center;
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 18pt;
                font-weight: 500;
                padding-top: 80px;
            }

            .deviceInto {
                text-align: center;
                background-color: whitesmoke;
                padding-top: 20px;
                padding-bottom: 80px;
            }

            .one .pawtrackerImg {
                margin: auto;
                padding-top: 0;
            }

            .subHeading {
                margin: auto;
                font-size: 45pt;
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-weight: bold;
                padding-top: 20px;
                padding-bottom: 20px;
                color: #245953;
            }

            .deviceName {
                font-size: 50pt;
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-weight: 800;
                line-height: 0;
            }

            .features {
                background-color: #fff;
            }

            .featureText1 {
                text-align: center;
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 25pt;
                font-weight: 500;
                color: #245953;
            }

            .featureText2 {
                text-align: center;
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 15pt;
                font-weight: 500;
            }

            .featureImg {
                text-align: center;
            } 

            .howToStart {
                text-align: center;
                background-color: whitesmoke;
                padding-top: 20px;
                padding-bottom: 60px;
            } 

            .subText1 {
                margin: auto;
                text-align: center;
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 15pt;
                font-weight: 500;
            }

            .step {
                margin: auto;
                text-align: center;
                width: 350px;
                height: 400px;
            }

            .step h3 {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 30pt;
                font-weight: bold;
                padding: 20px;
            }

            .step p {
                text-align: center;
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 15pt;
                font-weight: 500;
            }

            .subText2 {
                margin: auto;
                text-align: center;
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 15pt;
                font-weight: 500;
                padding-bottom: 50px;
            }

            .testimonals {
                text-align: center;
                padding-top: 20px;
                padding-bottom: 60px;
            } 

            .testimonalsBox {
                border: 2px solid white;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #fff;
                border-radius: 5px;
                margin: auto;
                padding: 16px;     
                width: 300px;
                height: 370px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 12pt;
            }

            .testimonalsBox h3 {
                font-size: 20pt;
                margin: auto;
                padding-top: 10px;
                padding-bottom: 10px;
            }

            .testimonalsBox h4 {
                font-size: 15pt;
                margin: auto;
                padding-bottom: 5px;
            }

            .testimonalsBox p {
                margin: auto;
                padding-top: 20px;
                text-align: justify;
            }

            .testimonalsBox img {
                float: left;
                margin-left: 25px;
                border-radius: 50%;
                height: 100px;
            }

            @media (max-width: 500px) {
                .testimonalsBox {
                    text-align: center;
                }
                .testimonalsBox img {
                    margin: auto;
                    float: none;
                    display: block;
                }
            }

            .reviewSection {
                background-color: whitesmoke;
                padding-top: 2px;
                padding-bottom: 50px;
            }

            .reviewHeading {
                text-align: center;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 30pt;
                font-weight: 700;
                color: #245953;
            }

            .reviewForm {
                margin: auto;
                width: 600px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 16pt;   
            }
            
            .formLabel {
                margin-bottom: 20px;
            }

            label {
                display: block;
                margin-bottom: 5px;
            }

            #rating {
                width: 620px;
            }

            input, select, textarea {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 2px solid white;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                font-size: 16px;
            }

            button {
                background-color:#245953;
                color: white;
                border: none;
                border-radius:5px;
                padding: 10px 10px;
                font-size: 18px;
                cursor: pointer;
                display: block;
                margin: auto;
                width: 620px;
            }

            button:hover {
                transform: scale(1.1);
            }     
            
            footer {
                background-color: #245953;
                display: flex;
                flex-wrap: wrap;
            }

            .aboutUs {
                margin: auto;
                margin-left: 100px;
                padding-top: 20px;   
                width: 500px;
                height: 250px;
            }

            .aboutUs h3 {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 18pt;
                color: #fff;
                font-weight: bold;
                margin-bottom: 20px;
            }

            .aboutUs p {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 12pt;
                color: #fff;
                line-height: 1.5;
                margin-bottom: 10px;
                font-weight: 450;
            } 

            .contactUs {
                margin: auto;
                padding-top: 20px;
                width: 300px;
                height: 250px;
            }

            .contactUs h3 {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 18pt;
                color: #fff;
                font-weight: bold;
                margin-bottom: 20px;
            }

            .contactUs p {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 12pt;
                color: #fff;
                line-height: 1.5;
                margin-bottom: 10px;
                font-weight: 450;
            } 

            .connectSM {
                margin: auto;
                padding-top: 20px;
                width: 300px;
                height: 250px;
            }

            .connectSM h3 {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 18pt;
                color: #fff;
                font-weight: bold;
                margin-bottom: 20px;
            }

            .fa {
                padding: 12px;
                font-size: 25px;
                width: 20px;
                height: 20px;
                text-align: center;
                text-decoration: none;
                margin: 5px 2px;
                border-radius: 50%;
            }

            .fa:hover {
                opacity: 0.7;
            }

            .fa-facebook {
                background: #3B5998;
                color: white;
            }

            .fa-twitter {
                background: #55ACEE;
                color: white;
            }

            .fa-instagram {
                background: #125688;
                color: white;
            }

            .fa-linkedin {
                background: #007bb5;
                color: white;
            }   

            #topBtn {
                width: 50px;
                height: 50px;
                text-align: center;
                display: none; 
                position: fixed; 
                bottom: 20px; 
                right: 30px; 
                z-index: 99; /* Make sure it does not overlap */
                border: none; 
                outline: none; 
                background-color: black; 
                color: white; 
                cursor: pointer; 
                padding: 15px; 
                border-radius: 50px; 
                font-size: 30px; 
                font-weight: bolder;
            }       

            #topBtn:hover {
                transform: scale(1.1);
                background-color: #245953;
            }
        </style>
    </head>

    <body>
        <header>
            <div class="menu">
                <a class="active" href="Home.html">Home</a>
                <a href="Daily report.php" target="_blank">Daily report</a>
                <a href="Find lost pet.php" target="_blank">Find your pet</a>
                <a href="Pet insurance.html" target="_blank">Pet insurance</a>
                <a href="Lost pets.html" target="_blank">Lost pets</a>
                <a href="Contact us.html" target="_blank">Contact Us</a> 

                <div class="login">
                    <button id="loginBtn" name="loginBtn" onclick="window.open('Login.php');" target='_blank'>Sign in</button>
                </div> 
            </div>
        </header>
        
        <main>
            <section>
                <div class="textBox">
                    <p class="websiteName">
                        PawCare
                    </p>

                    <p class="subHeadingText">
                        No more lost pets or worrying about their safety.</br></br>
                        PawCare comes with a range of features to keep your pets safe.
                    </p>
                </div>
              
                <div class="imgBox">
                      <img src="Home_page_assets\Img01.jpg" width="600" height="550">
                </div>
            </section>

            <div class="deviceInto">
                <p class="subHeading">
                    Everything starts with our device
                </p>

                <p class="deviceName">
                    PawTracker
                </p>

                <img src="Home_page_assets\Device img.png" class="pawtrackerImg">
            </div>

            <div class="features">
                <p class="featureText1">
                    PawTracker helps you keep track of your pets wherever they go.
                </p>   

                <p class="featureText2">
                    GPS technology to track your pet's location in real-time.</br>
                    View your pet's location on our mobile app or website.
                </p>

                <div class="featureImg">
                    <img src="Home_page_assets\Device with location tracking.jpg" width="500" height="500" class="pawtrackerImg">
                </div>

                <p class="featureText1">
                    Small and lightweight.
                </p>

                <p class="featureText2">
                    Easy to attach to your pet's collar.
                </p>

                <div class="featureImg">
                    <img src="Home_page_assets\Attach with pet.png" width="500" height="500">
                </div>
                

                <p class="featureText1">
                    Long-lasting battery.
                </p> 

                <p class="featureText2">
                    Don't have to worry about recharging it frequently.
                </p>
                
                <div class="featureImg">
                    <img src="Home_page_assets\Battery.png" width="450" height="500">
                </div>
            </div>

            <div class="howToStart">
                <p class="subHeading">
                    How to start with PawTracker?
                </p>

                <p class="subText1">
                    Follow these simple three steps.
                </p> 

                <section>
                    <div class="step">
                        <h3>
                            Step1
                        </h3>

                        <img src="Home_page_assets\Buy.png" width="100" height="100">

                        <p>
                            Buy the PawTracker device based on your pet you have.
                        </p>
                    </div>

                    <div class="step">
                        <h3>
                            Step2
                        </h3>

                        <img src="Home_page_assets\Sim card.png" width="100" height="100">

                        <p>
                            Insert IoT sim card into to PawTracker.
                        </p>
                    </div>

                    <div class="step">
                        <h3>
                            Step3
                        </h3>

                        <img src="Home_page_assets\Dog collar.png" width="100" height="100">

                        <p>
                            Fix the PawTracker into your pet's collar and start tracking.
                        </p>
                    </div>
                </section>
            </div>
           
            <div class="testimonals">
                <p class="subHeading">
                    What are our customers saying?
                </p>

                <p class="subText2">
                    Here are some customers sharing there experience with PawTracker.<br>
                </p>

                <section>
                    <div class="testimonalsBox">
                        <img src="Home_page_assets\Kapil.jpg" alt="Kapil image" style="width:100px">

                        <h3>
                            Kapil
                        </h3>

                        <h4>
                            5 out of 5 stars
                        </h4>
                        
                        <p>
                            I recently purchased the PawTracker pet tracking device for my dog and it has been a game changer. 
                            My dog loves to roam around and sometimes he would wander off too far, causing me to panic and search for him for hours. 
                            With this device, I can easily track his location in real time on my phone and get alerts if he goes outside of a certain area.
                        </p>
                    </div>

                    <div class="testimonalsBox">
                        <img src="Home_page_assets\Diluxshan.jpg" alt="Diluxshan image" style="width:100px">

                        <h3>
                            Diluxshan
                        </h3>

                        <h4>
                            4 out of 5 stars
                        </h4>

                        <p>
                            I have been using the PawTracker pet tracking device for a few weeks now and I am impressed with its accuracy and ease of use. 
                            My cat is an indoor cat, but occasionally she manages to escape outside and I would have to spend hours searching for her.
                            I particularly appreciate the geofencing feature that allows me to set a safe area for my cat. 
                            If she wanders outside of that area, I get an alert on my phone, which gives me peace of mind knowing that I can keep her safe.
                        </p>
                    </div>

                    <div class="testimonalsBox">
                        <img src="Home_page_assets\Jinosh.jpg" alt="Jinoshkanthan image" style="width:100px">

                        <h3>
                            Jinosh
                        </h3>

                        <h4>
                            4 out of 5 stars
                        </h4>

                        <p>
                            One thing I really appreciate about this device is that it's very durable. 
                            My dog loves to play rough and he's always getting into scrapes, but the device has held up really well. 
                            It's also water-resistant which is a big plus.
                            I'm really happy with my purchase and I would definitely recommend the PawTracker pet tracking device 
                            to any pet owner who wants to keep their furry friend safe and secure.
                        </p>
                    </div>
                </section>
            </div>

            <div class="reviewSection">
                <p class="reviewHeading">
                    Leave a review for us!
                </p> 

                <div class="reviewForm"> 
                
                    <form>
                        <div class="formLabel">
                            <label for="name">
                                Name:
                            </label>

                            <input type="text" id="name" name="name" required>
                        </div> 

                        <div class="formLabel">
                            <label for="rating">
                                Rating:
                            </label>

                            <select id="rating" name="rating" required>
                                <option value="">--Please choose a rating--</option>
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2">2 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                        </div>

                        <div class="formLabel">
                            <label for="review">
                                Review:
                            </label>

                            <textarea id="review" name="review" rows="5" required></textarea>
                        </div>

                        <div>
                            <button type="submit" id="reviewBtn" name="reviewBtn">
                                Submit Review
                            </button>
                        </div>
                    </form>
                </div> 
            </div>

            <footer>
                <section>
                    <div class="aboutUs">
                        <h3>
                            About Us
                        </h3>

                        <p>
                            We are a team of dedicated pet lovers who are passionate about providing the best safety and secure for your lovely pets.
                        </p>
                    </div>

                    <div class="contactUs">
                        <h3>
                            Contact Us
                        </h3>

                        <p>
                            Email: info@pawcare.com
                        </p>

                        <p>
                            Phone: 076-3931710
                        </p>

                        <p>
                            Address: No. 2/1, Sampath Uyana, 3rd mile post, Passara road, Badulla, Sri Lanka.
                        </p>
                    </div>

                    <div class="connectSM">
                        <h3>
                            Connect With Us
                        </h3>

                        <a href="https://web.facebook.com/login.php/?_rdc=1&_rdr" class="fa fa-facebook" target="_blank"></a>
                        <a href="https://twitter.com/login?lang=en" class="fa fa-twitter" target="_blank"></a>
                        <a href="https://www.instagram.com/accounts/login/" class="fa fa-instagram" target="_blank"></a>
                        <a href="https://www.linkedin.com/login" class="fa fa-linkedin" target="_blank"></a>
                    </div>
                </section>
            </footer>

            <button onclick="topFunction()" id="topBtn" name="topBtn">^</button>

            <script>
                //Get the button
                let Btn = document.getElementById("topBtn");

                //When the user scrolls down 20px from the top of the document, show the button
                window.onscroll = function() {
                    scrollFunction()
                };
    
                function scrollFunction() {
                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        Btn.style.display = "block";
                    } 
                    else {
                        Btn.style.display = "none";
                    }
                }

                //When the user clicks on the button, scroll to the top of the document
                function topFunction() {
                    document.documentElement.scrollTop = 0;
                }
            </script>
        </main>
    </body>
</html>