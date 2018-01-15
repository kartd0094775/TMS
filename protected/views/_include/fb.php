<!-- facebook -->
<div id="fb-root"></div>
<script>
	function fbLogin() {

		if (!isFbLogin) {
			FB.login(function(response) {

				if (response.authResponse) {

					toPage('facebookLoginDo', 'login');

				} else {

				}
			}, {
				// scope : 'email,user_birthday'
				scope : 'email'
			});
		} else {

			// alert('yada');
			FB.login(function(response) {

				if (response.authResponse) {

					toPage('facebookLoginDo', 'login');

				} else {

				}
			}, {
				// scope : 'email,user_birthday'
				scope : 'email'
			});


		}
	}

	function fbLoginCallBack() {

	}

	var isFbLogin = false;

	window.fbAsyncInit = function() {
		FB.init({
			appId : fbAppID,
			cookie : true,
			xfbml : true,
			oauth : true,
			version : 'v2.5'
		});

		FB.getLoginStatus(function(r) {
			if (r.status == 'connected') {
				isFbLogin = true;
			} else {
				isFbLogin = false;
			}

		});

	};

	//---------------
	( function(d, s, id) {
			var js,
			    fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {
				return;
			}
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

</script>

<!--
<script>
window.fbAsyncInit = function() {
FB.init({
appId      : 'your-app-id',
xfbml      : true,
cookie : true,
oauth : true,
version    : 'v2.5'
});
};

(function(d, s, id){
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) {return;}
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script> -->

<!--

<div
class="fb-like"
data-share="true"
data-width="450"
data-show-faces="true">
</div>

<script>
window.fbAsyncInit = function() {
FB.init({
appId      : '192874377741374',
xfbml      : true,
version    : 'v2.5'
});
};

(function(d, s, id){
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) {return;}
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

-->

