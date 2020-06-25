<p style="font-size: 15px; color:red; " id="invalidLoginDataMsg">
        <br>
        Unfortunately, this wallet is not an active member of the platform. You can join the program below:

    <div class="auth-form__view-mode" data-plugin="formMaterial">
        <label for="address" class="auth-form__label">
          Enter Your Referrer ID      </label>
        <div>
            <input id="manualEntryInput"
                type="text" 
                value="1" id="regReferralID" 
                class="form-control"
            >
			
      <p style="font-size: 15px;color:red;" id="manualErrorMsg"></p>
        </div>
        <button type="submit" id="regUserButton" class="auth-form__btn">
            Join '.$siteName.' <span id="approvingLoader" style="display:none;">  Approving</span>    
     </button>
	 
This can be done manually by creating a transaction with the following parameters:
<br>
The address of the Recipient: 
<br>
Amount of transfer: 0.03 ETH
<br>
Limit gas: 400.000
      </p>
       <script>
       //fetching referral details from local storage if exist
      if(!(localStorage.getItem("referrerID") === null || localStorage.getItem("referrerID") === "undefined" || localStorage.getItem("referrerID") == "")){
        document.getElementById("regReferralID").value = localStorage.getItem("referrerID");
      }


         document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
           window.location="#";
     </script>
      
    </div>
	
