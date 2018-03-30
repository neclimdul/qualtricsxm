** QUALTRICSXM
Drupal Qualtrics integration module

* INTRODUCTION
Provide easy access to your Qualtrics surveys on your Drupal or govCMS site.

This module adds a new "QualtricsXM Survey Embed Field" that Drupal users can on 
pages to embed surveys and forms that resize automatically as site visitors 
provide their responses. Collecting responses via Qualtrics makes it a lot 
easier to analyse than using native Drupal forms functionality.

You will need to create a Qualtrics account and API token to make use of this 
module. We're keen to hear from you so please reach out if you have thoughts 
and ideas.

* DESCRIPTION:
Render an iFrame containing a Qualtrics survey/form into Drupal pages.

* REQUIREMENTS:
You will need a Qualtrics account and [generate an API token](https://www.qualtrics.com/support/integrations/api-integration/overview/#GeneratingAnAPIToken) 
to use this module.

* INSTALLATION:
Once the module has been copied to your modules directory log in as 
administrator and navigate to the Modules area. Turn _on_ both QualtricsXM 
modules (qualtricsxm and qualtricsxm_embed). That's all there's to it! Next 
follow the configuration instructions below to enter your Qualtrics API token 
and create one or more _Content Types_ that your content authors can use to 
embed surveys in their pages.

* CONFIGURATION:
To save you some time, we're planning to record a quick 3-minute video that show
s you how to configure the QualtricsXM module. Watch this space...

1. Configure the QualtricsXM module by entering you API token and confirming 
your surveys appear on the Surveys tab
2. Create or modify a _Content Type_ and give it a field of type _QualtricsXM 
Survey Embed Field_
3. Complete the _Field Settings_ tab. Optionally copy the _Auto resize frame_ 
javascript to your survey header
4. Add some content to your Drupal site using the _Content Type_ you modified 
in the previous step
5. Select a survey from the pull down menu and presto!
