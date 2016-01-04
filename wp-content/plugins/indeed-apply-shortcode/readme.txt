=== Indeed Apply Shortcode ===
Contributors: Indeed.com, Taylor4484
Tags: indeed, apply, jobs, job, application, mobile apply, Indeed Apply, career page, jobs page, job search, shortcode, email application
Requires at least: 3.2
Tested up to: 4.0
Stable tag: 1.5
License: Apache 2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0.html

Easily accept job applications from any device, including mobile.



== Description ==

Privately and securely accept job applications by email with Indeed Apply using a simple shortcode.

Indeed Apply is the way [Indeed](http://www.indeed.com/ "Indeed | one search. all jobs."), the world's leading search engine for jobs, accepts applications from job seekers across the globe.

With Indeed Apply Shortcode, candidates on your website can easily apply to jobs from any device, including mobile, using a simple and user-friendly form.

*  It’s completely free and easy to set-up
*  Millions of job seekers use Indeed Apply
*  Indeed Apply works on desktop and mobile devices
*  Provides best experience for job seekers and employers alike
*  Your email addressed is never exposed to job seekers or bots
*  Requires no change to your hiring process

Basic Shortcode Usage:

[indeed-apply jobtitle="Interaction Designer" emailapplicationto="apply@yourdomain.com"]


= More Information About Indeed Apply =

* [Add Indeed Apply to your jobs | Easily apply to jobs from anywhere](http://www.indeed.com/hire/indeed-apply "About Indeed Apply")
* [Your candidates are mobile. Are you? | Indeed Blog Post](http://blog.indeed.com/2013/03/25/your-candidates-are-mobile-are-you/ "Indeed Blog")
* [Indeed Apply boosts applications on web and mobile | Indeed Blog Post](http://blog.indeed.com/2012/07/26/indeed-apply-boosts-applications-on-web-and-mobile/ "Indeed Blog")



== Installation ==

1. Upload the 'indeed-apply-shortcode' directory to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit the Indeed Apply Configuration Page under the 'Settings' Menu in the WordPress Admin
4. Enter your API Key and Secret from [https://secure.indeed.com/account/apikeys](https://secure.indeed.com/account/apikeys "Indeed API Signup"). You will need to create a free Indeed Account / or sign into your existing Indeed Account
5. Add the [indeed-apply ...] shortcode anywhere you want an Indeed Apply Button

_Note: If you have WordPress 2.7 or above you can simply go to 'Plugins' > 'Add New' in the WordPress admin and search for "Indeed Apply Shortcode" and install it from there._


= Basic Usage =
The Indeed Apply shortcode can be added to any post/page/custom post type. Use the shortcode anywhere you would normally put an email address to accept job applications, or on any job listing.

A basic Indeed Apply shortcode:

[indeed-apply jobtitle="Interaction Designer" emailapplicationto="apply@yourdomain.com"]

There is no limit on number of Indeed Apply shortcodes you can use on a single page.

There are only two required attributes:

1. __jobtitle__ -  The title of the job the current indeed apply button references, this will be used in the application form.
2. __emailapplicationto__ - the email address where you would like job applications sent.

The emailapplicaitonto attribute is encrypted by the plugin and never displayed in the HTML or to the applicant. This is done to protect your email from spambots and email abuse.


= Advanced Usage =

The Indeed Apply shortcode accepts several advanced attributes that allow for custom configuration of your job application.

A complete Indeed Apply shortcode:

[indeed-apply jobtitle="Interaction Designer" emailapplicationto="apply@yourdomain.com" jobcompanyname="Awesome Company Inc" joblocation="Austin, Texas" phone="required" coverletter="required" continueurl="https://www.yourdomain.com/submit-success"]

All supported attributes:

* __jobtitle__ (required) -  The title of the job the current indeed apply button references, this will be used in the application form.
* __emailapplicationto__ (required) - The email address where you would like job applications sent. This value is encrypted, and not exposed in the source code or presented to job seekers.
* __jobcompanyname__ - The company name for the job posting.
* __joblocation__ - The location of the job. This can be a city, state or a full address.
* __phone__ - This displays a phone number field on the job application. This attribute accepts one of three values: 'required', 'optional', 'hidden'. The default value (when not specifying the attribute) is 'optional'.
* __coverletter__ - This displays a cover letter field on the job application. This attribute accepts one of three values, 'required', 'optional', 'hidden'. The default value (when not specifying the attribute) is 'optional'.
* __continueurl__ - The URL an applicant is redirected to when they complete an application. This is commonly used for a thank you page. The URL must have http:// or https://



== Frequently Asked Questions ==


= Common Issues =


= I added the shortcode to my post but nothing displays on the frontend =
The shortcode was built to not display errors on the frontend of your site if the plugin is not configured correctly

Below are troubleshooting tips to try before posting a support topic:

*  Ensure that you have configured your API Token and Secret on the Indeed Apply Settings page
*  Ensure your email address in the shortcode is correct, the plugin will filter out an invalid email address.
*  Ensure that the shortcode attributes are lowercase, and that their values are in quotes.


= Where is the Indeed Apply Settings Page? =
You can find the Indeed Apply Settings Page under the main 'Settings' Menu in the WordPress admin.

_Note: The Indeed Apply Settings page is only visible to Users with Administrator and Editor privileges._


= Where can I get an Indeed Apply API Token and Key? =
You can generate an API Token and Key at [https://secure.indeed.com/account/apikeys](https://secure.indeed.com/account/apikeys "Indeed API Signup")

1. You will need to create a free Indeed Account / or sign into your existing Indeed Account to request an API key
2. Once you login you will see a section titled 'Add Indeed Apply on your website'
3. Add a description of your API usage (e.g. your website/company name) and click, 'Add API Key'
4. Copy and Paste your Token and Secret onto the Indeed Apply Settings Page


= Why do I need an Indeed Apply API Token and Key? =
Indeed Apply Shortcode encrypts your email address and never displayed in the HTML or to the applicant. This is done to protect your email from spambots and email abuse.

To do this, you have to request an API Token and Key so we can decrypt your email address when an applicant submits an application and it is processed on our secure servers. The email you provide to this plugin will only be used to process applications submitted through Indeed Apply.

You can read Indeed's Privacy Policy online at http://www.indeed.com/legal#privacy


= Is there a limit on the number of Indeed Apply Shortcodes I can use across my site? =
No, there is no limit. The plugin supports multiple Indeed Apply shortcodes per page. At Indeed we’ve found putting one Indeed Apply Button on each job posting works best.


= Why are email addresses showing up as @indeedemail.com? =
Job applications processed by Indeed Apply are submitted with an @indeedemail.com email address. This protects the job seeker's privacy, reduces spam, and helps us increase applicant quality. Messages to @indeedemail.com email address will be sent to the job seeker's original email address.


= Where can I use the Indeed Apply Shortcode? =
The Indeed Apply shortcode can be added to any post/page/custom post type. If you would like to use any shortcode in your widget areas you can add the following line to your theme's functions.php file to allow shortcodes to be used:

`add_filter('widget_text', 'do_shortcode');`

Developers who want to use the Indeed Apply shortcode in their themes or plugins can use the WordPress function [do_shortcode](http://codex.wordpress.org/Function_Reference/do_shortcode "WordPress Codex") in their PHP code.

Assuming your Page/Post Title is the Job Title, you can use this code in your template files, while inside the WordPress Loop, replacing the all caps text with relevant info for your company:

`<?php echo do_shortcode('[indeed-apply jobtitle="' . get_the_title() .'" emailapplicationto=" YOUR EMAIL ADDRESS" joblocation=" JOB LOCATION " jobcompanyname=" COMPANY NAME'); ?>`

= I’m still having trouble, where can I get support? =
*  View [Indeed Apply Shortcode Support Topics](http://wordpress.org/support/plugin/indeed-apply-shortcode "Indeed Apply Shortcode Support Topics")
*  For all other issues or questions [Contact Indeed](https://ads.indeed.com/contact_indeed?subject=Indeed+Apply+Wordpress+Plugin "Indeed for Employers")

= Terms of service =
The plugin source code is Apache 2.0, however use of Indeed Apply through this plugin is governed by Indeed's [Cookies, Privacy and Terms of Service Policies](http://www.indeed.com/legal "Indeed Cookies, Privacy and Terms of Service").



== Screenshots ==

1. Job posting with an Indeed Apply button
2. User-friendly, mobile-optimized Indeed Apply application form
3. The application confirmation email generated by Indeed Apply, sent to applicants.
4. The email application generated by Indeed Apply, sent to the Employer
5. Indeed Apply Shortcode in the WordPress Post Editor
6. Indeed Apply Settings Page



== Changelog ==

= 1.5 =
* Update compatibility for WordPress 4.0
* Add fallback to jobcompanyname
* Update documentation
* Add plugin icons

= 1.4 =
* Update broken documentation link on Setting Page and clarify helper text

= 1.3 =
* Fix issue in 1.2 that prevented the plugin from initializing

= 1.2 =
* Fix issue where the shortcode would try to remove paragraphs from the post content
* Add debug shortcode parameter to help with debugging
* Compatibility tested from WP 3.2 through WP 3.9
* Add blame authors to docblock to aid internal plugin development

= 1.1 =
* Support alternate shortcode misspelling


= 1.0 =
* Initial Release



== Upgrade Notice ==

= 1.5 =
* Update compatibility for WordPress 4.0
* Add fallback to jobcompanyname
* Update documentation
* Add plugin icons

= 1.4 =
* Update broken documentation link on Setting Page and clarify helper text

= 1.3 =
* Fix issue in 1.2 that prevented the plugin from initializing

= 1.2 =
* Fix issue where the shortcode would try to remove paragraphs from the post content
* Add debug shortcode parameter to help with debugging
* Compatibility for WP 3.9

= 1.1 =
* Support alternate shortcode misspelling

= 1.0 =
* Initial Release