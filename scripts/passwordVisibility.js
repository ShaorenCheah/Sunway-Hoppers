$(document).ready(function() {
  var loginEyeIcon = $('#loginModal .input-group-text a');
  var registerEyeIcon = $('#registerModal .userPwdEye a');
  var repeatRegisterEyeIcon = $('#registerModal .userRepeatPwdEye a');
  var adminEyeIcon = $('#addAdminModal .adminPwdEye a');
  var repeatAdminEyeIcon = $('#addAdminModal .adminRepeatPwdEye a');
  
  // // Toggle password visibility
  loginEyeIcon.click(function() {
    changeVisibility('#accPwd', loginEyeIcon);
  });
  registerEyeIcon.click(function() {
    changeVisibility('#userPwd', registerEyeIcon);
  });
  repeatRegisterEyeIcon.click(function() {
    changeVisibility('#repeatPwd', repeatRegisterEyeIcon);
  });
  adminEyeIcon.click(function() {
    changeVisibility('#adminPwd', adminEyeIcon);
  });
  repeatAdminEyeIcon.click(function() {
    changeVisibility('#repeatAdminPwd', repeatAdminEyeIcon);
  });
  
  function changeVisibility(input, icon){
    // Check the type of the password input
    var passwordInput = $(input);
    var passwordType = passwordInput.attr('type');

    // Toggle the password input type between text and password and change the icon 
    if (passwordType == 'password') {
      passwordInput.attr('type', 'text');
      icon.html('<i class="bi bi-eye-fill password-icon"></i>');
    } else {
      passwordInput.attr('type', 'password');
      icon.html('<i class="bi bi-eye-slash-fill password-icon"></i>');
    }
  }

});