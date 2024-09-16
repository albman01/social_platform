import Echo from 'laravel-echo'

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: 'ec22075fbfa665f6d93d',
  cluster: 'eu',
  forceTLS: true
});

var channel = Echo.channel('my-channel');
channel.listen('.my-event', function(data) {
  alert(JSON.stringify(data));
});