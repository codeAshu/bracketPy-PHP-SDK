<?php
/**
 * Example of API Client for bracketPy Machine Learning API.
 * 
 * @author Ashutosh Trivedi
 * @link   http://www.bracketpy.com/
 */
 
class BracketPyAPI {
    const version='1.0';
    
    protected $api_key;
    
    /**
    * Constructor
    * 
    * @param string $api_key
    * @return bracketPyAPI
    */
    public function __construct($api_key) {
        $this->api_key=$api_key;
    }
    
    /**
    * Calls the Web Service of bracketPy
    * 
    * @param string $api_method
    * @param array $POSTparameters
    * 
    * @return string $jsonreply
    */
    protected function CallWebService($api_method,$POSTparameters) {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://bracketpy.p.mashape.com/'.$api_method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_POST, true );
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-Mashape-Key: '.$this->api_key,
    'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTparameters);
        $jsonreply = curl_exec ($ch);
        curl_close ($ch);
        unset($ch);
        return $jsonreply;
    }
    
    /**
    * Parses the API Reply
    * 
    * @param mixed $jsonreply
    * 
    * @return mixed
    */
    protected function ParseReply($jsonreply) {
        
        $jsonreply=json_decode($jsonreply, true);
        
        if(isset($jsonreply['output']) && $jsonreply['msg']=='OK') {
            return $jsonreply['output'];
        }
        
        if(isset($jsonreply['code']) && $jsonreply['msg']!='OK') {
            echo $jsonreply['msg'].' (ErrorCode: '.$jsonreply['code'] .')';
        }
        
        return false;
    }
    
    /**
    * Performs Summary of a web page or text content.
    * 
    * @param string $content text content or web url of the content
    * 
    * @return list It returns list of sentences in descending order of preference
    */
    public function summary($content, $size=15) {
        $parameters=array(
            'content'=>$content,
            'size' => $size
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('summary',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    /**
    * Performs Image Recognition.
    * 
    * @param string $url Link to image 
    * 
    * @return string It returns prediction of image
    */
    public function imageRecognition($url) {
        $parameters=array(
            'url'=>$url,
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('imgclass',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    /**
    * Performs cleaning of dirty twitter text.
    * 
    * @param string $data text of tweet
    * 
    * @return string It returns cleaned and spell corrected text
    */
    public function cleanTweets($data) {
        $parameters=array(
            'data'=>$data,
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('cleanChat',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    
    /**
    * Performs concept extraction from a content
    * 
    * @param string $data text content or web url of the content
    * 
    * @return string It returns concepts mentioned in the text and their wikipedia link
    */
    public function conceptExtraction($data) {
        $parameters=array(
            'data'=>$data,
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('conceptExtraction',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    
    /**
    * Performs context extraction of a youTube video
    * 
    * @param string $url Link to you tube video
    * 
    * @return string It returns context data related to the video
    */
    public function youTubeContext($url) {
        $parameters=array(
            'url'=>$url,
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('getYouTubeContext',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    /**
    * Performs similarity analysis on two documents
    * 
    * @param string $doc_1 text of first document or link to first document 
    * @param string $doc_2 text of second document or link to second document 
    * 
    * @return string It returns similarity score of two documents
    */
    public function docSimilarity($doc_1, $doc_2) {
        $parameters=array(
            'doc_1'=>$doc_1,
            'doc_2'=>$doc_2
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('docSimilarity',$content);
        
        return $this->ParseReply($jsonreply);
    }

    /**
    * Performs similarity analysis on two phrases, based on their occurance in past in web
    * 
    * @param string $word_1 first word
    * @param string $word_2 second word
    * 
    * @return string It returns similarity score of two words
    */
    public function wordSimilarity($word_1, $word_2) {
        $parameters=array(
            'word_1'=>$doc_1,
            'word_2'=>$doc_2
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('similarityIndex',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
            
    /**
    * Fetch all the urls from a webpage
    * 
    * @param string $url url of the webpage
    * 
    * @return list a list of all the urls connected to that web page
    */
    public function fetchUrls($url) {
        $parameters=array(
            'url'=>$url,
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('fetchUrls',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    
    
    /**
    * Generate keywords from text which can be used as hashtags and topic 
    * 
    * @param string $data text content or web url of the content
    * 
    * @return list a list of all the topics and hastags extracted from the data
    */
    public function hashTags($data) {
        $parameters=array(
            'data'=>$data,
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('hashTags',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    /**
    * Fetch Named Entities from the data It fetch Location, Organization and Person 
    * 
    * @param string $data text content or web url of the content
    * 
    * @return list a list of all the Named entities extracted from the data
    */
    public function NERExtraction($data) {
        $parameters=array(
            'data'=>$data,
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('nerTag',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    /**
    * This API takes a query string and return all the similar phrases related to that query. 
    * The similar phrases are phrases which have occurred with the query on web in past
    * 
    * @param string $query phrase to query, please use underscore for two_word phrase
    * 
    * @return list a list of all phrases which are similar in context
    */
    public function similarPhrases($query) {
        $parameters=array(
            'query'=>$query,
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('similarPhrases',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    
    /**
    * This API categorizes given url/text into predefined set of categories based on it's content. 
    * We have 10 broad level categories--'home', 'arts', 'games', 'health', 'society', 'computers', '
    * business', 'recreation', 'sports', ‘science’. Each of these 10 categories have sub-categorization, 
    * if it is specificallt mentioned with these categories.
    * 
    * @param string $data text content or web url of the content
    * @param string $topic any topic mentioned in the description
    *
    * @return list a list of all the category with score
    */
    public function categoryDetection($data, $topic = 'topic') {
        $parameters=array(
            'data'=>$data,
            'topic'=>$topic
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('getTopics',$content);
        
        return $this->ParseReply($jsonreply);
    }
    

    /**
    * Performs the sentiment analysis of the content
    * @param string $data text content or web url of the content
    *
    * @return dictionary a dict of sentiment with score in each category
    */
    public function sentimentDetection($data) {
        $parameters=array(
            'data'=>$data  
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('getSentiment',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    /**
    * Performs the language analysis of the content
    * @param string $data text content or web url of the content
    *
    * @return dictionary a dict of all language with score in each category
    */
    public function languageDetection($data) {
        $parameters=array(
            'data'=>$data  
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('getLanguage',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    /**
    * Performs the tone analysis of the content
    * @param string $data text content or web url of the content
    *
    * @return dictionary a dict of all tones (corporate or personal ) with score in each category
    */
    public function toneDetection($data) {
        $parameters=array(
            'data'=>$data  
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('getTone',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    /**
    * Performs the mood analysis of the content
    * @param string $data text content or web url of the content
    *
    * @return dictionary a dict of all moods (happy or sad) with score in each category
    */
    public function moodDetection($data) {
        $parameters=array(
            'data'=>$data  
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('getMood',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    
    /**
    * It's a machine learning model which trains on the data provided by the user. 
    * Model learns from the provided categories and predicts the category of the 
    * un-categorized text. Classification is based on semantics and conceptual information 
    * extracted from the text/ url.
    * 
    * @param Array $content  
    * e.g.
    * array(
    *   array(
    *      "category" => "Climate-Change",
    *      "data" => "http://www.un.org/climatechange/summit/"
    *  ),
    *
    *   array(
    *      "category" => "None",  (For the ones which have to be classified)
    *     "data" => "python is dynamically typed language, it also infer the data type"
    *    ),
    *   )
    * In this Array of array, training set has category described, and for the ones which have to classified,
    * please mention category as 'None'
    *
    * @param ignore-flag , can have values 0/1. If 1: it will ignore the faulty urls
    *                                           If 0: it will stop
    * @return dictionary a dict of category predicted by the model trained on the data provided
    */
    public function classify($content, $ignoreFlag = 1) {
        $parameters=array(
            'content'=>$content,
            'ignore-flag'=>$ignoreFlag
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('classify',$content);
        
        return $this->ParseReply($jsonreply);
    }
    
    
    /**
    * Performs semantic matching of a target sentence with a list of sentences
    * @param string $target text, sentence from which the matching is needed
    * @param list $sentences list of all other sentences
    *
    * @return list, a list of score which show the semantic similarity of target sentence
    */
    public function sentenceSimilarityn($target, $sentences) {
        $parameters=array(
            'target'=>$target,
            'sentences' => $sentences 
        );
        $content = json_encode($parameters);
        
        $jsonreply=$this->CallWebService('sentenceSimilarity',$content);
        
        return $this->ParseReply($jsonreply);
    }
       
}
//$bpy = new BracketPyAPI('Your-API-Keys');

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