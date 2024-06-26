


function changeView() {
    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");
  

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");

}


function signup() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("e", email.value);
    form.append("p", password.value);


    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                document.getElementById("msg").innerHTML = "Registration Successfull";
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
            } else {
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msgdiv").className = "d-block";
            }

        }
    }

    request.open("POST", "signupProcess.php", true);
    request.send(form);
}
function signin() {

    var email = document.getElementById("email1");
    var password = document.getElementById("password1");
    var rememberme = document.getElementById("rememberme");


    var form = new FormData();
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("r", rememberme.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg1").innerHTML = response;
                document.getElementById("msgdiv1").className = "d-block";
            }

        }
    }

    request.open("POST", "signInProcess.php", true);
    request.send(form);

}
var forgotPasswordModal;

function forgotPassword() {

    var email = document.getElementById("email1");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var text = request.responseText;

            if (text == "Success") {

                Swal.fire({
                    title: "Verification code has sent successfully. Please check your Email",
                  
                    icon: "success"
                  });
                // alert("Verification code has sent successfully. Please check your Email.");
                document.getElementById("fpmodal").className = "login-container-d-box";
                document.getElementById("signInBox").className = "d-none";
            } else {
                document.getElementById("msg1").innerHTML = text;
                document.getElementById("msgdiv1").className = "d-block";
            }

        }
    }

    request.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    request.send();

}
function resetPassword() {

    var email = document.getElementById("email1");
    var newPassword = document.getElementById("np");
    var retypePassword = document.getElementById("rnp");
    var verification = document.getElementById("vcode");

    var form = new FormData();
    form.append("e", email.value);
    form.append("n", newPassword.value);
    form.append("r", retypePassword.value);
    form.append("v", verification.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                // alert("Password updated successfully.");
            
                Swal.fire({
                    title: "Password updated successfully.",
                  
                    icon: "success"
                  });
                  forgotPasswordModal.hide();
            } else {
                document.getElementById("msg1").innerHTML = text;
                document.getElementById("msgdiv1").className = "d-block";
            }
        }
    }

    request.open("POST", "resetPasswordProcess.php", true);
    request.send(form);

}
function signout() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                Swal.fire({
                    title: "Do you want to LogOut ?.",
                  
                    icon: "warning"
                    
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
              
            }
        }
    }

    request.open("GET", "signOutProcess.php", true);
    request.send();

}
function addProduct() {
    var category = document.getElementById("category");
    var title = document.getElementById("title");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("ca", category.value);


    form.append("t", title.value);

    form.append("q", qty.value);
    form.append("co", cost.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("de", desc.value);

    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        form.append("image" + x, image.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
    
            if (response == "success") {
                Swal.fire({
                    title: "Product Saved Successfully.",
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            } else {
                Swal.fire({
                    title: "somthing went wrong",
                    icon: "error"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        }
    }
    
    request.open("POST", "addProductProcess.php", true);
    request.send(form);
    
}

function changeProductImage() {

    var image = document.getElementById("imageuploader");

    image.onchange = function () {
        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {

                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
            }

        } else {
          
            Swal.fire({
                title: file_count + " files. You are proceed to upload only 3 or less than 3 files.",
                icon: "error"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        }
    }

}


function addToCart(id ){
    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var response = request.responseText;
            if(response.trim() === "Please Login or Signup first."){
                Swal.fire({
                    title: "Please Login or Signup First",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Login",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "login.php";
                    }
                });
            } else {
                Swal.fire({
                    title: response,
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        }
    };

    request.open("GET", "addToCartProcess.php?id=" + id, true);
    request.send();
}

function changeQTY(id, inputId) {
    var qty = document.getElementById(inputId).value;

    if (qty <= 0) {
        Swal.fire({
            title: "Invalid Quantity",
            icon: "error"
        });
        return;
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (request.status == 200) {
                if (response === "Updated") {
                    window.location.reload();
                } else {
                    Swal.fire({
                        title: response,
                        icon: response === "Invalid Quantity" ? "error" : "info"
                    });
                }
            } else {
                Swal.fire({
                    title: "Error updating quantity",
                    icon: "error"
                });
            }
        }
    };

    request.open("GET", "cartQtyUpdateProcess.php?qty=" + qty + "&id=" + id, true);
    request.send();
}


function deleteFromCart(id){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function (){
        if(request.status == 200 & request.readyState == 4){
            var response = request.responseText;
            if(response == "Removed"){
            
                Swal.fire({
                    title: "Product successfully Removed",
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
             
            }else{
                Swal.fire({
                    title: "Somthing went wrong",
                    icon: "error"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        }
    }

    request.open("GET","deleteFromCartProcess.php?id=" + id,true);
    request.send();

}
function changeProfileImg() {
    var img = document.getElementById("profileimage");

    img.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("img").src = url;
    }

}
function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimage");

    var form = new FormData();

    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("l1", line1.value);
    form.append("l2", line2.value);
    form.append("p", province.value);
    form.append("d", district.value);
    form.append("c", city.value);
    form.append("pc", pcode.value);

    if (image.files.length > 0) {
        form.append("i", image.files[0]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "Updated" || response == "Saved") {
                Swal.fire({
                    title: "Profile Updated",
                    text: "Your profile has been updated successfully.",
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            } else if (response == "You have not selected any image.") {
                Swal.fire({
                    title: "No Image Selected",
                    text: "You have not selected any image.",
                    icon: "warning"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: response,
                    icon: "error"
                });
            }
        }
    };

    request.open("POST", "updateProfileProcess.php", true);
    request.send(form);
}


function adminVerification() {
  var email = document.getElementById("e");

  var f = new FormData();

  f.append("mail", email.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var signUpBox = document.getElementById("verificationModal1");
        var signInBox = document.getElementById("verificationModal2");
        Swal.fire({
            title: "Verification code has sent successfully. Please check your Email",
          
            icon: "success"
          });



  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
       
      } else {
        Swal.fire({
            title: t,
          
            icon: "error"
          });
      }
    }
  };

  r.open("POST", "adminVerificationProcess.php", true);
  r.send(f);
}
function verify() {
    var verification = document.getElementById("vcode");
  
    var r = new XMLHttpRequest();
  
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        if (t == "success") {
      
          window.location = "adminPanel.php";
        } else {
            Swal.fire({
                title: t,
              
                icon: "error"
              });
        }
      }
    };
    r.open("GET", "verificationProcess.php?v=" + verification.value, true);
    r.send();
  }
  
function blockUser(email) {
    var request = new XMLHttpRequest();
  
    request.onreadystatechange = function () {
      if (request.readyState == 4) {
        var txt = request.responseText;
        if (txt == "blocked") {
          document.getElementById("ub" + email).innerHTML = "Unblock";
          document.getElementById("ub" + email).classList = "Active-btn";
        } else if (txt == "unblocked") {
          document.getElementById("ub" + email).innerHTML = "Block";
          document.getElementById("ub" + email).classList = "block-btn";
        } else {
            Swal.fire({
                title: txt,
              
                icon: "error"
              });
        }
      }
    };
  
    request.open("GET", "userBlockProcess.php?email=" + email, true);
    request.send();
  }
  
  function blockProduct(id) {
    var request = new XMLHttpRequest();
  
    request.onreadystatechange = function () {
      if (request.readyState == 4) {
        var txt = request.responseText;
        if (txt == "blocked") {
          document.getElementById("pb" + id).innerHTML = "Unblock";
          document.getElementById("pb" + id).classList = "Active-btn";
        } else if (txt == "unblocked") {
          document.getElementById("pb" + id).innerHTML = "Block";
          document.getElementById("pb" + id).classList = "block-btn";
        } else {
            Swal.fire({
                title: txt,
              
                icon: "error"
              });
        }
      }
    };
  
    request.open("GET", "productBlockProcess.php?id=" + id, true);
    request.send();
  }
  function openModal(productId) {
    // Save the product id for later use
    sessionStorage.setItem('productId', productId);

    // Open the modal
    var myModal = new bootstrap.Modal(document.getElementById('updateFlavorModal'));
    myModal.show();
}
function updateFavorqty() {
    var productId = sessionStorage.getItem('productId');
    var flavorqty = document.getElementById("uf").value;

    var formData = new FormData();
    formData.append('productId', productId);
    formData.append('flavorname', flavorqty);

    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status === 200) {
            Swal.fire({
                title: 'Quantity  Updated',
                text: 'Quantity updated successfully',
                icon: 'success'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: 'An error occurred while updating the quantity',
                icon: 'error'
            });
        }
    };
    xhr.open('POST', 'updateFlavorProcess.php', true);
    xhr.send(formData);
}

function updateCatogory(){

    var cn = document.getElementById("c-name");



    var form = new FormData();
    form.append("cn", cn.value);


    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "NEW CATOGORY ADDED") {
              
              Swal.fire({
                title: response,
                icon: "success"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
            
            } else {
                Swal.fire({
                    title: response,
                    icon: "error"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                
            }

        }
    }

    request.open("POST", "updatecatogory.php", true);
    request.send(form);

}
// ************************************************************************************
function deactiveCategory(catId) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var txt = request.responseText;
            if (txt == "blocked") {
                document.getElementById("cb" + catId).innerHTML = "Active";
                document.getElementById("cb" + catId).classList = "Active-btn";
            } else if (txt == "unblocked") {
                document.getElementById("cb" + catId).innerHTML = "De-Active";
                document.getElementById("cb" + catId).classList = "block-btn";
            } else {
                Swal.fire({
                    title: txt,
                    icon: "error"
                });
            }
        }
    };

    request.open("GET", "deactiveCategoryProcess.php?catId=" + catId, true);
    request.send();
}
// ***************

    
function payNow(id) {
    var qty = document.getElementById("qty_num").value;
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            var obj = JSON.parse(response);

            var mail = obj["umail"];
            var amount = obj["amount"];

            if (response == 1) {
                Swal.fire({
                    title: 'Please Login',
                    text: 'You need to be logged in to proceed with the payment.',
                    icon: 'info'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "home.php";
                    }
                });
            } else if (response == 2) {
                Swal.fire({
                    title: 'Update Profile',
                    text: 'Please update your profile before making a purchase.',
                    icon: 'info'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "userProfile.php";
                    }
                });
            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    Swal.fire({
                        title: 'Payment Completed',
                        text: 'Payment completed. OrderID: ' + orderId,
                        icon: 'success'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            saveInvoice(orderId, id, mail, amount, qty);
                        }
                    });
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    Swal.fire({
                        title: 'Payment Dismissed',
                        text: 'The payment window was closed. Please try again.',
                        icon: 'warning'
                    });
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    Swal.fire({
                        title: 'Payment Error',
                        text: 'An error occurred during the payment process: ' + error,
                        icon: 'error'
                    });
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["mid"],    // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/singleProductView.php?id=" + id,     // Important
                    "cancel_url": "http://localhost/eshop/singleProductView.php?id=" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount + ".00",
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                payhere.startPayment(payment);
            }
        }
    }

    request.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    request.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("i", id);
    form.append("m", mail);
    form.append("a", amount);
    form.append("q", qty);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                Swal.fire({
                    title: response,
                    icon: "error"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        }
    }

    request.open("POST", "saveInvoiceProcess.php", true);
    request.send(form);

}
function printInvoice() {
    var restorePage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
}
var m;
function addFeedback(id) {
    var feedbackModal = document.getElementById("feedbackmodal" + id);
    m = new bootstrap.Modal(feedbackModal);
    m.show();
}
function saveFeedback(id) {

    var type;

    if (document.getElementById("type1").checked) {
        type = 1;
    } else if (document.getElementById("type2").checked) {
        type = 2;
    } else if (document.getElementById("type3").checked) {
        type = 3;
    }

    var feedback = document.getElementById("feed");

    var form = new FormData();
    form.append("pid", id);
    form.append("t", type);
    form.append("f", feedback.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                alert("Feedback saved.");
                m.hide();
            } else {
                Swal.fire({
                    title: response,
                  
                    icon: "error"
                  });
            }
        }
    }

    request.open("POST", "saveFeedbackProcess.php", true);
    request.send(form);

}
function createPDFOfPage() {
    const { jsPDF } = window.jspdf;
    const element = document.getElementById('page');

    html2canvas(element).then((canvas) => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF({
            orientation: 'portrait',
            unit: 'px',
            format: [canvas.width, canvas.height]
        });

        pdf.addImage(imgData, 'PNG', 0, 0);
        pdf.save('page.pdf');
    });
}
let map;

async function initMap() {
  const { Map } = await google.maps.importLibrary("maps");

  map = new Map(document.getElementById("map"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 8,
  });
}

initMap();

function sendMessage(user, id) {
    var msg = document.getElementById("msg").value;

    var subjectElement = document.getElementById("subject");
    var selectedRating = subjectElement.options[subjectElement.selectedIndex].text;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            if (r.responseText == "Success") {
                document.getElementById("msg").value = "";
                
                Swal.fire({
                    title: 'Message Sent',
                    text: 'Your message has been sent successfully.',
                    icon: 'success'
                }).then((result) => {
                    if (result.isConfirmed) {
                        loadChat();
                        window.location.reload();
                    }
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred while sending your message.',
                    icon: 'error'
                });
            }
        }
    };

    r.open("GET", "savechat.php?msg=" + encodeURIComponent(msg) + "&sub=" + encodeURIComponent(selectedRating) + "&pid=" + id + "&user=" + user, true);
    r.send();
}

function advancedSearch(x){

    var txt = document.getElementById("t");
    var category = document.getElementById("c1");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("s");
  

    var form = new FormData();

    form.append("cat",category.value);
    form.append("t",txt.value);
    form.append("pf",from.value);
    form.append("pt",to.value);
    form.append("s",sort.value);
    form.append("page",x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function (){
        if(request.status == 200 && request.readyState == 4){
            var response = request.responseText;
            document.getElementById("view_area").innerHTML = response;
        }
    }

    request.open("POST","advancedSearchProcess.php",true);
    request.send(form);

}
$(document).ready(function() {

    fetch("load.php")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Something went wrong!");
            }

            return response.json();
        })
        .then((data) => {

            console.log(data);

            var qty = [];
            var name = [];

            data.qty.forEach((data) => {
                qty.push(data);
            });
            data.name.forEach((data) => {
                name.push(data);
            });

            // chart 1
            const barColors1 = [
                "#b91d47",
                "#00aba9",
                "#2b5797",
                "#e8c3b9",
                "#1e7145"
            ];

            new Chart("myChart", {
                type: "doughnut",
                data: {
                    labels: name,
                    datasets: [{
                        backgroundColor: barColors1,
                        data: qty
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: "Daily Selling History"
                    }
                }
            });



        })
        .catch((error) => {
            console.log(error);
        });

            });

$(document).ready(function() {

    fetch("load2.php")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Something went wrong!");
            }

            return response.json();
        })
        .then((data) => {

            console.log(data);

            const months = Object.keys(data);
            const productNames = new Set();
            const datasets = [];

            // Collect all product names
            months.forEach(month => {
                Object.keys(data[month]).forEach(title => {
                    productNames.add(title);
                });
            });

            // Create a dataset for each product
            productNames.forEach(product => {
                const dataset = {
                    label: product,
                    data: months.map(month => data[month][product] || 0),
                    backgroundColor: getRandomColor()
                };
                datasets.push(dataset);
            });

            // Helper function to generate random colors
            function getRandomColor() {
                const letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            new Chart("myChart1", {
                type: "bar",
                data: {
                    labels: months,
                    datasets: datasets
                },
                options: {
                    title: {
                        display: true,
                        text: "Monthly Selling History"
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Quantity Sold'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Months'
                            }
                        }
                    }
                }
            });
        })
        .catch((error) => {
            console.log(error);
        });
});


$(document).ready(function() {

    fetch("load3.php")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Something went wrong!");
            }

            return response.json();
        })
        .then((data) => {

            console.log(data);

            const years = Object.keys(data);
            const productNames = new Set();
            const datasets = [];

            // Collect all product names
            years.forEach(year => {
                Object.keys(data[year]).forEach(title => {
                    productNames.add(title);
                });
            });

            // Create a dataset for each product
            productNames.forEach(product => {
                const dataset = {
                    label: product,
                    data: years.map(year => data[year][product] || 0),
                    backgroundColor: getRandomColor()
                };
                datasets.push(dataset);
            });

            // Helper function to generate random colors
            function getRandomColor() {
                const letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            new Chart("myChart2", {
                type: "bar",
                data: {
                    labels: years,
                    datasets: datasets
                },
                options: {
                    title: {
                        display: true,
                        text: "Yearly Selling History"
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Quantity Sold'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Years'
                            }
                        }
                    }
                }
            });
        })
        .catch((error) => {
            console.log(error);
        });
});
function fetchData() {
    var service = document.getElementById('serviceDropdown').value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_feedback.php?service=' + service, true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('feedbackTable').innerHTML = this.responseText;
        }
    };
    xhr.send();
}
function changePassword() {
    var cp = document.getElementById("cpass").value;
    var np = document.getElementById("newpass").value;
    var rnp = document.getElementById("renewpass").value;
    var email = document.getElementById("email22").value;


    if (np !== rnp) {
        Swal.fire({
            title: "Passwords do not match.",
            icon: "error"
        });
        return;
    }

    var form = new FormData();
    form.append("cp", cp);
    form.append("np", np);
    form.append("rnp", rnp);
    form.append("email", email);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response.trim() === "success") {
                Swal.fire({
                    title: "Password updated successfully.",
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            } else {
                Swal.fire({
                    title: response,
                    icon: "error"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        }
    };

    request.open("POST", "changePasswordProcess.php", true);
    request.send(form);
}




function payNow2(p) {
  
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            var obj = JSON.parse(response);

            var mail = obj["umail"];
            var amount = obj["amount"];

            if (response == 1) {
                Swal.fire({
                    title: 'Please Login',
                    text: 'You need to be logged in to proceed with the payment.',
                    icon: 'info'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "home.php";
                    }
                });
            } else if (response == 2) {
                Swal.fire({
                    title: 'Update Profile',
                    text: 'Please update your profile before making a purchase.',
                    icon: 'info'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "userProfile.php";
                    }
                });
            } else {

                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    Swal.fire({
                        title: 'Payment Completed',
                        text: 'Payment completed. OrderID: ' + orderId,
                        icon: 'success'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            saveInvoice2(orderId, mail);
                        }
                    });
                };

          
                payhere.onDismissed = function onDismissed() {
                    Swal.fire({
                        title: 'Payment Dismissed',
                        text: 'The payment window was closed. Please try again.',
                        icon: 'warning'
                    });
                    console.log("Payment dismissed");
                };

               
                payhere.onError = function onError(error) {
                    Swal.fire({
                        title: 'Payment Error',
                        text: 'An error occurred during the payment process: ' + error,
                        icon: 'error'
                    });
                    console.log("Error:" + error);
                };

                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["mid"],    
                    "return_url": "http://localhost/eshop/singleProductView.php?id=" + p,     
                    "cancel_url": "http://localhost/eshop/singleProductView.php?id=" + p,     
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount + ".00",
                    "currency": "LKR",
                    "hash": obj["hash"],
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                
                payhere.startPayment(payment);
            }
        }
    }

    request.open("GET", "buyNowProcess2.php?p=" + p, true);
  request.send();
}

function saveInvoice2(orderId, mail) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("m", mail);


    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "invoice.php?id=" + orderId;

              
            } else {
                Swal.fire({
                    title: response,
                    icon: "error"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        }
    }

    request.open("POST", "saveinvoice2.php", true);
    request.send(form);

}