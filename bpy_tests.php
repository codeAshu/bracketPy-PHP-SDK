<?php

$bpy = new BracketPyAPI('Your-API-Keys');

$target = "In the eighteenth century it was often convenient to regard man as a clockwork automaton.";
$sentences =array( "In the eighteenth century it was often convenient to regard man as a clockwork automaton.", 
"in the eighteenth century    it was often convenient to regard man as a clockwork automaton", 
"In the eighteenth century, it was often convenient to regard man as a clockwork automaton.", 
"In the eighteenth century, it was not accepted to regard man as a clockwork automaton.", 
"In the eighteenth century, it was often convenient to regard man as clockwork automata.", 
"In the eighteenth century, it was often convenient to regard man as clockwork automatons.", 
"It was convenient to regard man as a clockwork automaton in the eighteenth century.", 
"In the 1700s, it was common to regard man as a clockwork automaton.", 
"In the 1700s, it was convenient to regard man as a clockwork automaton.", 
"In the eighteenth century.", "Man as a clockwork automaton.", 
"In past centuries, man was often regarded as a clockwork automaton.",
"The eighteenth century was characterized by man as a clockwork automaton.", 
"Very long ago in the eighteenth century, many scholars regarded man as merely a clockwork automaton.");


print $bpy->{'sentenceSimilarityn'}($target, $sentences); //print the result/

$content = array(
array("category"=> "Climate-Change", "data"=> "http://www.un.org/climatechange/summit/"),
array("category"=> "Coding", "data"=> "http://www.geeksforgeeks.org/queue-using-stacks/"),
array("category"=> "random", "data"=> "random"),
array("category"=> "None", "data"=> "python is dynamically typed language, it also infer the data type"), 
array("category"=> "None", "data"=> "http://www.ecokids.ca/PUB/games_activities/climate_change/index.cfm")
);



$con_data = "At a small media event in Mountain View today, Google announced the launch of Chromebox for Meetings, a \
$999 Core \
i7-based ASUS Chromebox setup with a remote, camera and microphone for conference rooms. The system uses Hangouts \
in the backend and is also compatible with existing conferencing setups from Vidyo and UberConference \
(for phone calls). The system includes all the components necessary to run a meeting, with the exception of a \
display. For the first year, users don’t have to pay any additional costs; after that, the cost is $250 per year. \
The product is available in the U.S. today and is coming to Australia, Canada, France, Japan, \
New Zealand, Spain and U.K. Businesses in the U.S. will be able to buy it through CDW, and resellers will \
be able to get it from SYNNEX. Both HP and Dell will make Chromeboxes for meetings available in the \
coming months. As Google VP for Product Management Caesar Sengupta noted during today’s event, despite all \
the advances in video conferencing technology, remote meetings are still too hard. Over time, Google itself \
has developed a variety of solutions for its own teams and now, the company has decided to make some of this \
technology available to other businesses as well. Sengupta hopes that this product “will transform meetings and \
meeting rooms. When you think of a meeting room, they have looked the same for the last 25 years.” \
It’s never clear when a meeting room is really available because the printout from the morning that somebody \
 pinned to the door may not be up to date anymore. The system is deeply integrated with Google Calendar, which\
will also allow you to schedule conference rooms. The display will always show the schedule for the room \
(and rotate pictures in the background). If you’ve ever set up a Chromecast, the design will look very familiar.\
Because the system uses Hangouts in the background, users can attend these meetings from any device that can\
run Hangouts. In total, Chromebox for Meetings supports up to 15 video streams (Hangouts itself tops out\
jka.dcjdcjcjk jcnkdsnckjncdc jkncdjsncdnCNCJNCALCJCNKJCCkjcn";




print $bpy->{'sentimentDetection'}($con_data); //print the result/
print $bpy->{'toneDetection'}($con_data); //print the result/
print $bpy->{'moodDetection'}($con_data); //print the result/
print $bpy->{'languageDetection'}($con_data); //print the result/


$doc_1 = "http://www.thehindu.com/news/national/sheena-bora-murder-case-indrani-mukerjea-taken-to-world-home-a-day-before-custody-ends/article7622108.ece";
$doc_2 = "http://www.firstpost.com/india/shes-a-hard-nut-to-crack-custody-of-indrani-driver-rai-and-khanna-extended-till-7-sept-2422568.html";


print $bpy->{'categoryDetection'}($doc_1); //print the result

print $bpy->{'wordSimilarity'}('nice', 'good'); //print the result

print $bpy->{'similarPhrases'}('usa'); //print the result

print $bpy->{'conceptExtraction'}($con_data); //print the result
print $bpy->{'hashTags'}($con_data); //print the result
print $bpy->{'NERExtraction'}($con_data); //print the result

$fet_url = "http://www.thehindu.com/news/national/sheena-bora-murder-case-indrani-mukerjea-taken-to-world-home-a-day-before-custody-ends/article7622108.ece";
print $bpy->{'fetchUrls'}($fet_url); //print the result



$doc_1 = "This is a really interesting article we found on Science and Dogs that needs more exposure. First off, \
# there is nothing wrong with owning \
# 'purebreds' because all dogs need loving homes, but a dog should never be bred with intentional defects";

$doc_2 = "The dogs on the left are from the 1915 book, Breeds of All Nations by W.E. Mason. The examples on the \
# right are modern examples from multiple sources. To be able to make an honest comparison, I've chosen \
# pictures with similar poses and in \
# a couple of cases flipped the picture to get them both aligned in the same direction.";

//$doc_1 = "http://www.thehindu.com/news/national/sheena-bora-murder-case-indrani-mukerjea-taken-to-world-home-a-day-before-custody-ends/article7622108.ece";
//$doc_2 = "http://www.firstpost.com/india/shes-a-hard-nut-to-crack-custody-of-indrani-driver-rai-and-khanna-extended-till-7-sept-2422568.html";


print $bpy->{'docSimilarity'}($doc_1, $doc_2); //print the result


$you_url = "https://www.youtube.com/watch?v=LSQpWZlKAaA";
print $bpy->{'youTubeContext'}($you_url); //print the result

$tweet = "RT @ #happyfuncoding: ths is a tpical Twitter tweet w/ http://t.co/4UusFTLwob. \
HTML entities &amp; other Web oddities cn b an &aacute;cute <em class='grumpy'>pain</em> >:( . \
you can also  hav phn nums  like +1 (900) 123-4567, (400) 123-4567, and 123-4567 in any where . \
y do u wanna kno what i'm doin m nt dat good & g8 it abt it nd I don't want  ne1 to know it.";
print $bpy->{'cleanTweets'}($tweet); //print the result

$im_url = "http://fashiongum.com/wp-content/uploads/2015/01/High-Heels-for-Spring-Summer-2015-3.jpg";
print $bpy->{'imageRecognition'}($im_url); //print the result

$smry_url = "http://www.mnn.com/lifestyle/eco-tourism/stories/the-mystery-of-devils-kettle-falls";
print $bpy->{'summary'}($smry_url); //print the result

?>