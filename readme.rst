###################
Introduction
###################

This is a sample set up of codeigniter 3.0 when you want to build a REST API. Go through the initial commit history and note the files that have been added. All API controllers should be a subclass of TT_REST_Controller.php.

If you have a some POST functions that need to have basic authentication you can edit the _authenticate function in TT_REST_Controller to add you're logic. You can leverage the user_details property so that all authenticated API functions have access to a users details via : $this->user_details.

By default all POST functions will go through "_authenticate" unless you add the following code to your controller (replace method names in the array):

$this->open_methods = array('open_post');

###################
Testing
###################

Download the following plugin from the Google Chrome Store:
https://chrome.google.com/webstore/detail/advanced-rest-client/hgmloofddffdnphfgcellkdfbfbjeloo
Once downloaded select "Request"

************
Testing GET Methods:
************

In the URL field set the url to something like this:

http://dev.sample.com:8888/index.php/api/sample/list
& the make sure the GET Radio button is selected.

/api/sample/list - this is the important part. It means look into the api folder in the sample controller and call the list_get function. 

************
Testing POST Methods
************

In the URL field set the url to something like this:

http://dev.sample.com:8888/index.php/api/sample/open
& the make sure you add params in Payload section (switch it to form view and add some values eg. "sample_input" : 1. Refer the sample controller to see params you should test with

/api/sample/open - this is the important part. It means look into the api folder in the sample controller and call the open_post function. 

************
Troubleshooting
************

- In advanced rest client make sure the "content-type" is set to application/x-www-form-urlencoded
- If you've edited routes.php you might have to tweak this a bit.

###################
Server Requirements
###################

PHP version 5.4 or newer is recommended.

It should work on 5.2.4 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.
