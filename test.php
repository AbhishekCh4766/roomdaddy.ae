<!DOCTYPE html>
<html>
<head>
	<title>Deskto Notifications</title>
</head>
<body>
  <a href="#" id="dnperm">Request Permisions</a>
  <a href="#" id="dntrigger">Trigger Permisions</a>


  <script>
  	var dnperm = document.getElementById('dnperm');
  	var dntrigger = document.getElementById('dntrigger');

  	dnperm.addEventListener('click', function(e){
       e.preventDefault();

       if(!window.Notification){
       	alert('Sorry, Notifications are not supported!');
       } else{
       	//alert('Good, Notifications are Enabled!');
       	Notification.requestPermission(function(p) { 

       console.log(p);
       if(p === 'denied'){
       	alert('You Denied Notifications!');
       }else if(p === 'granted'){
       	alert('You granted Notifications!');
       }
       	});

       }
  	});

   // Permissions allowed
       dntrigger.addEventListener('click', function(e){
       	var notify;

       	e.preventDefault();

       	if(Notification.permission === 'default'){
       		alert('Please, Allow Notification before going Forward');
       	} else{
       		notify = new Notification('New Message from Roomdaddy.', {
       			body: 'Hello, Your Problem will be resolved today.',
       			icon: 'img/room.png'
       		});
       	}
       });
  </script>
</body>
</html>