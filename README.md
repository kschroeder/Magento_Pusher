# Magento_Pusher
A quick integration POC for Pusher and Magento

It is really easy to use this module.  Copy it into your Magento installation and via the admin go to System Configuration > Advanced > System.  Find the Eschrade Pusher group and enter the secret, auth (or app key) and application ID.  Make sure you enable it and then save the configuration.

The module does not integrate with the JavaScript API, it only enables it and so in your HTML you will need to put something like the following code.


    var channel = pusher.subscribe('test_channel');
    channel.bind('my_event', function(data) {
      alert(data.message);
    });

To test it, use the Curl command provided on your Pusher app page, such as 

```
curl -H 'Content-Type: application/json' -d '{"data":"{\"message\":\"hello world\"}","name":"my_event","channel":"test_channel"}' \
"http://api.pusherapp.com/apps/{APPID}/events?"\
"body_md5={MD5}&"\
"auth_version=1.0&"\
"auth_key={AUTHKEY}&"\
"auth_timestamp=1433857606&"\
"auth_signature={SIGNATURE}&"
```

You should see a popup on your page.with the hello world message.

To send a message to Pusher all you need is the following code.

        $data['message'] = 'hello world';
        Mage::getModel('eschrade_pusher/pusher')->trigger('test_channel', 'my_event', $data);
