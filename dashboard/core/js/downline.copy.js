function myFunctionCopy() {
		var copyText = document.getElementById("myRefLink");
		  copyText.select();
		  copyText.setSelectionRange(0, 99999)
		  document.execCommand("copy");
		  document.getElementById("copyButton").textContent="Copied";

      }
      function myFunctionCopy2() {
		var copyText = document.getElementById("trustWalletLinkCopy");
		  copyText.select();
		  copyText.setSelectionRange(0, 99999)
		  document.execCommand("copy");
		  document.getElementById("copyButton2").textContent="Copied";

      }