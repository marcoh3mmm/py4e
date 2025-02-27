<?php if ( file_exists("../booktop.php") ) {
  require_once "../booktop.php";
  ob_start();
}?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
<head>
  <meta charset="utf-8" />
  <meta name="generator" content="pandoc" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <title>-</title>
  <style>
    html {
      line-height: 1.5;
      font-family: Georgia, serif;
      font-size: 20px;
      color: #1a1a1a;
      background-color: #fdfdfd;
    }
    body {
      margin: 0 auto;
      max-width: 36em;
      padding-left: 50px;
      padding-right: 50px;
      padding-top: 50px;
      padding-bottom: 50px;
      hyphens: auto;
      overflow-wrap: break-word;
      text-rendering: optimizeLegibility;
      font-kerning: normal;
    }
    @media (max-width: 600px) {
      body {
        font-size: 0.9em;
        padding: 1em;
      }
    }
    @media print {
      body {
        background-color: transparent;
        color: black;
        font-size: 12pt;
      }
      p, h2, h3 {
        orphans: 3;
        widows: 3;
      }
      h2, h3, h4 {
        page-break-after: avoid;
      }
    }
    p {
      margin: 1em 0;
    }
    a {
      color: #1a1a1a;
    }
    a:visited {
      color: #1a1a1a;
    }
    img {
      max-width: 100%;
    }
    h1, h2, h3, h4, h5, h6 {
      margin-top: 1.4em;
    }
    h5, h6 {
      font-size: 1em;
      font-style: italic;
    }
    h6 {
      font-weight: normal;
    }
    ol, ul {
      padding-left: 1.7em;
      margin-top: 1em;
    }
    li > ol, li > ul {
      margin-top: 0;
    }
    blockquote {
      margin: 1em 0 1em 1.7em;
      padding-left: 1em;
      border-left: 2px solid #e6e6e6;
      color: #606060;
    }
    code {
      font-family: Menlo, Monaco, 'Lucida Console', Consolas, monospace;
      font-size: 85%;
      margin: 0;
    }
    pre {
      margin: 1em 0;
      overflow: auto;
    }
    pre code {
      padding: 0;
      overflow: visible;
      overflow-wrap: normal;
    }
    .sourceCode {
     background-color: transparent;
     overflow: visible;
    }
    hr {
      background-color: #1a1a1a;
      border: none;
      height: 1px;
      margin: 1em 0;
    }
    table {
      margin: 1em 0;
      border-collapse: collapse;
      width: 100%;
      overflow-x: auto;
      display: block;
      font-variant-numeric: lining-nums tabular-nums;
    }
    table caption {
      margin-bottom: 0.75em;
    }
    tbody {
      margin-top: 0.5em;
      border-top: 1px solid #1a1a1a;
      border-bottom: 1px solid #1a1a1a;
    }
    th {
      border-top: 1px solid #1a1a1a;
      padding: 0.25em 0.5em 0.25em 0.5em;
    }
    td {
      padding: 0.125em 0.5em 0.25em 0.5em;
    }
    header {
      margin-bottom: 4em;
      text-align: center;
    }
    #TOC li {
      list-style: none;
    }
    #TOC a:not(:hover) {
      text-decoration: none;
    }
    code{white-space: pre-wrap;}
    span.smallcaps{font-variant: small-caps;}
    span.underline{text-decoration: underline;}
    div.column{display: inline-block; vertical-align: top; width: 50%;}
    div.hanging-indent{margin-left: 1.5em; text-indent: -1.5em;}
    ul.task-list{list-style: none;}
    .display.math{display: block; text-align: center; margin: 0.5rem auto;}
  </style>
  <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
  <![endif]-->
</head>
<body>
<h1 id="using-web-services">Using Web Services</h1>
<p>Once it became easy to retrieve documents and parse documents over HTTP using programs, it did not take long to develop an approach where we started producing documents that were specifically designed to be consumed by other programs (i.e., not HTML to be displayed in a browser).</p>
<p>There are two common formats that we use when exchanging data across the web. eXtensible Markup Language (XML) has been in use for a very long time and is best suited for exchanging document-style data. When programs just want to exchange dictionaries, lists, or other internal information with each other, they use JavaScript Object Notation (JSON) (see <a href="http://www.json.org">www.json.org</a>). We will look at both formats.</p>
<h2 id="extensible-markup-language---xml">eXtensible Markup Language - XML</h2>
<p>XML looks very similar to HTML, but XML is more structured than HTML. Here is a sample of an XML document:</p>
<pre class="xml"><code>&lt;person&gt;
  &lt;name&gt;Chuck&lt;/name&gt;
  &lt;phone type=&quot;intl&quot;&gt;
    +1 734 303 4456
  &lt;/phone&gt;
  &lt;email hide=&quot;yes&quot; /&gt;
&lt;/person&gt;</code></pre>
<p>Each pair of opening (e.g., <code>&lt;person&gt;</code>) and closing tags (e.g., <code>&lt;/person&gt;</code>) represents a <em>element</em> or <em>node</em> with the same name as the tag (e.g., <code>person</code>). Each element can have some text, some attributes (e.g., <code>hide</code>), and other nested elements. If an XML element is empty (i.e., has no content), then it may be depicted by a self-closing tag (e.g., <code>&lt;email /&gt;</code>).</p>
<p>Often it is helpful to think of an XML document as a tree structure where there is a top element (here: <code>person</code>), and other tags (e.g., <code>phone</code>) are drawn as <em>children</em> of their <em>parent</em> elements.</p>
<figure>
<img src="../images/xml-tree.svg" alt="A Tree Representation of XML" style="height: 2.0in;"/>
<figcaption>
A Tree Representation of XML
</figcaption>
</figure>
<h2 id="parsing-xml">Parsing XML</h2>
<p>  </p>
<p>Here is a simple application that parses some XML and extracts some data elements from the XML:</p>
<pre class="python"><code>import xml.etree.ElementTree as ET

data = &#39;&#39;&#39;
&lt;person&gt;
  &lt;name&gt;Chuck&lt;/name&gt;
  &lt;phone type=&quot;intl&quot;&gt;
    +1 734 303 4456
  &lt;/phone&gt;
  &lt;email hide=&quot;yes&quot; /&gt;
&lt;/person&gt;&#39;&#39;&#39;

tree = ET.fromstring(data)
print(&#39;Name:&#39;, tree.find(&#39;name&#39;).text)
print(&#39;Attr:&#39;, tree.find(&#39;email&#39;).get(&#39;hide&#39;))

# Code: http://www.py4e.com/code3/xml1.py</code></pre>
<p>The triple single quote (<code>'''</code>), as well as the triple double quote (<code>"""</code>), allow for the creation of strings that span multiple lines.</p>
<p>Calling <code>fromstring</code> converts the string representation of the XML into a “tree” of XML elements. When the XML is in a tree, we have a series of methods we can call to extract portions of data from the XML string. The <code>find</code> function searches through the XML tree and retrieves the element that matches the specified tag.</p>
<pre><code>Name: Chuck
Attr: yes</code></pre>
<p>Using an XML parser such as <code>ElementTree</code> has the advantage that while the XML in this example is quite simple, it turns out there are many rules regarding valid XML, and using <code>ElementTree</code> allows us to extract data from XML without worrying about the rules of XML syntax.</p>
<h2 id="looping-through-nodes">Looping through nodes</h2>
<p> </p>
<p>Often the XML has multiple nodes and we need to write a loop to process all of the nodes. In the following program, we loop through all of the <code>user</code> nodes:</p>
<pre class="python"><code>import xml.etree.ElementTree as ET

input = &#39;&#39;&#39;
&lt;stuff&gt;
  &lt;users&gt;
    &lt;user x=&quot;2&quot;&gt;
      &lt;id&gt;001&lt;/id&gt;
      &lt;name&gt;Chuck&lt;/name&gt;
    &lt;/user&gt;
    &lt;user x=&quot;7&quot;&gt;
      &lt;id&gt;009&lt;/id&gt;
      &lt;name&gt;Brent&lt;/name&gt;
    &lt;/user&gt;
  &lt;/users&gt;
&lt;/stuff&gt;&#39;&#39;&#39;

stuff = ET.fromstring(input)
lst = stuff.findall(&#39;users/user&#39;)
print(&#39;User count:&#39;, len(lst))

for item in lst:
    print(&#39;Name&#39;, item.find(&#39;name&#39;).text)
    print(&#39;Id&#39;, item.find(&#39;id&#39;).text)
    print(&#39;Attribute&#39;, item.get(&#39;x&#39;))

# Code: http://www.py4e.com/code3/xml2.py</code></pre>
<p>The <code>findall</code> method retrieves a Python list of subtrees that represent the <code>user</code> structures in the XML tree. Then we can write a <code>for</code> loop that looks at each of the user nodes, and prints the <code>name</code> and <code>id</code> text elements as well as the <code>x</code> attribute from the <code>user</code> node.</p>
<pre><code>User count: 2
Name Chuck
Id 001
Attribute 2
Name Brent
Id 009
Attribute 7</code></pre>
<p>It is important to include all parent level elements in the <code>findall</code> statement except for the top level element (e.g., <code>users/user</code>). Otherwise, Python will not find any desired nodes.</p>
<pre class="python"><code>import xml.etree.ElementTree as ET

input = &#39;&#39;&#39;
&lt;stuff&gt;
  &lt;users&gt;
    &lt;user x=&quot;2&quot;&gt;
      &lt;id&gt;001&lt;/id&gt;
      &lt;name&gt;Chuck&lt;/name&gt;
    &lt;/user&gt;
    &lt;user x=&quot;7&quot;&gt;
      &lt;id&gt;009&lt;/id&gt;
      &lt;name&gt;Brent&lt;/name&gt;
    &lt;/user&gt;
  &lt;/users&gt;
&lt;/stuff&gt;&#39;&#39;&#39;

stuff = ET.fromstring(input)

lst = stuff.findall(&#39;users/user&#39;)
print(&#39;User count:&#39;, len(lst))

lst2 = stuff.findall(&#39;user&#39;)
print(&#39;User count:&#39;, len(lst2))</code></pre>
<p><code>lst</code> stores all <code>user</code> elements that are nested within their <code>users</code> parent. <code>lst2</code> looks for <code>user</code> elements that are not nested within the top level <code>stuff</code> element where there are none.</p>
<pre><code>User count: 2
User count: 0</code></pre>
<h2 id="javascript-object-notation---json">JavaScript Object Notation - JSON</h2>
<p> </p>
<p>The JSON format was inspired by the object and array format used in the JavaScript language. But since Python was invented before JavaScript, Python’s syntax for dictionaries and lists influenced the syntax of JSON. So the format of JSON is nearly identical to a combination of Python lists and dictionaries.</p>
<p>Here is a JSON encoding that is roughly equivalent to the simple XML from above:</p>
<pre class="json"><code>{
  &quot;name&quot; : &quot;Chuck&quot;,
  &quot;phone&quot; : {
    &quot;type&quot; : &quot;intl&quot;,
    &quot;number&quot; : &quot;+1 734 303 4456&quot;
   },
   &quot;email&quot; : {
     &quot;hide&quot; : &quot;yes&quot;
   }
}</code></pre>
<p>You will notice some differences. First, in XML, we can add attributes like “intl” to the “phone” tag. In JSON, we simply have key-value pairs. Also the XML “person” tag is gone, replaced by a set of outer curly braces.</p>
<p>In general, JSON structures are simpler than XML because JSON has fewer capabilities than XML. But JSON has the advantage that it maps <em>directly</em> to some combination of dictionaries and lists. And since nearly all programming languages have something equivalent to Python’s dictionaries and lists, JSON is a very natural format to have two cooperating programs exchange data.</p>
<p>JSON is quickly becoming the format of choice for nearly all data exchange between applications because of its relative simplicity compared to XML.</p>
<h2 id="parsing-json">Parsing JSON</h2>
<p>We construct our JSON by nesting dictionaries and lists as needed. In this example, we represent a list of users where each user is a set of key-value pairs (i.e., a dictionary). So we have a list of dictionaries.</p>
<p>In the following program, we use the built-in <code>json</code> library to parse the JSON and read through the data. Compare this closely to the equivalent XML data and code above. The JSON has less detail, so we must know in advance that we are getting a list and that the list is of users and each user is a set of key-value pairs. The JSON is more succinct (an advantage) but also is less self-describing (a disadvantage).</p>
<pre class="python"><code>import json

data = &#39;&#39;&#39;
[
  { &quot;id&quot; : &quot;001&quot;,
    &quot;x&quot; : &quot;2&quot;,
    &quot;name&quot; : &quot;Chuck&quot;
  } ,
  { &quot;id&quot; : &quot;009&quot;,
    &quot;x&quot; : &quot;7&quot;,
    &quot;name&quot; : &quot;Brent&quot;
  }
]&#39;&#39;&#39;

info = json.loads(data)
print(&#39;User count:&#39;, len(info))

for item in info:
    print(&#39;Name&#39;, item[&#39;name&#39;])
    print(&#39;Id&#39;, item[&#39;id&#39;])
    print(&#39;Attribute&#39;, item[&#39;x&#39;])

# Code: http://www.py4e.com/code3/json2.py</code></pre>
<p>If you compare the code to extract data from the parsed JSON and XML you will see that what we get from <code>json.loads()</code> is a Python list which we traverse with a <code>for</code> loop, and each item within that list is a Python dictionary. Once the JSON has been parsed, we can use the Python index operator to extract the various bits of data for each user. We don’t have to use the JSON library to dig through the parsed JSON, since the returned data is simply native Python structures.</p>
<p>The output of this program is exactly the same as the XML version above.</p>
<pre><code>User count: 2
Name Chuck
Id 001
Attribute 2
Name Brent
Id 009
Attribute 7</code></pre>
<p>In general, there is an industry trend away from XML and towards JSON for web services. Because the JSON is simpler and more directly maps to native data structures we already have in programming languages, the parsing and data extraction code is usually simpler and more direct when using JSON. But XML is more self-descriptive than JSON and so there are some applications where XML retains an advantage. For example, most word processors store documents internally using XML rather than JSON.</p>
<h2 id="application-programming-interfaces">Application Programming Interfaces</h2>
<p>We now have the ability to exchange data between applications using HyperText Transport Protocol (HTTP) and a way to represent complex data that we are sending back and forth between these applications using eXtensible Markup Language (XML) or JavaScript Object Notation (JSON).</p>
<p>The next step is to begin to define and document “contracts” between applications using these techniques. The general name for these application-to-application contracts is <em>Application Program Interfaces</em> (APIs). When we use an API, generally one program makes a set of <em>services</em> available for use by other applications and publishes the APIs (i.e., the “rules”) that must be followed to access the services provided by the program.</p>
<p>When we begin to build our programs where the functionality of our program includes access to services provided by other programs, we call the approach a <em>Service-oriented architecture</em> (SOA). A SOA approach is one where our overall application makes use of the services of other applications. A non-SOA approach is where the application is a single standalone application which contains all of the code necessary to implement the application.</p>
<p>We see many examples of SOA when we use the web. We can go to a single web site and book air travel, hotels, and automobiles all from a single site. The data for hotels is not stored on the airline computers. Instead, the airline computers contact the services on the hotel computers and retrieve the hotel data and present it to the user. When the user agrees to make a hotel reservation using the airline site, the airline site uses another web service on the hotel systems to actually make the reservation. And when it comes time to charge your credit card for the whole transaction, still other computers become involved in the process.</p>
<figure>
<img src="../images/soa.svg" alt="Service-oriented architecture" style="height: 3.0in;"/>
<figcaption>
Service-oriented architecture
</figcaption>
</figure>
<p>A Service-oriented architecture has many advantages, including: (1) we always maintain only one copy of data (this is particularly important for things like hotel reservations where we do not want to over-commit) and (2) the owners of the data can set the rules about the use of their data. With these advantages, an SOA system must be carefully designed to have good performance and meet the user’s needs.</p>
<p>When an application makes a set of services in its API available over the web, we call these <em>web services</em>.</p>
<h2 id="security-and-api-usage">Security and API usage</h2>
<p> </p>
<p>It is quite common that you need an API key to make use of a vendor’s API. The general idea is that they want to know who is using their services and how much each user is using. Perhaps they have free and pay tiers of their services or have a policy that limits the number of requests that a single individual can make during a particular time period.</p>
<p>Sometimes once you get your API key, you simply include the key as part of POST data or perhaps as a parameter on the URL when calling the API.</p>
<p>Other times, the vendor wants increased assurance of the source of the requests and so they expect you to send cryptographically signed messages using shared keys and secrets. A very common technology that is used to sign requests over the Internet is called <em>OAuth</em>. You can read more about the OAuth protocol at <a href="http://www.oauth.net">www.oauth.net</a>.</p>
<p>Thankfully there are a number of convenient and free OAuth libraries so you can avoid writing an OAuth implementation from scratch by reading the specification. These libraries are of varying complexity and have varying degrees of richness. The OAuth web site has information about various OAuth libraries.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>API</dt>
<dd>Application Program Interface - A contract between applications that defines the patterns of interaction between two application components.
</dd>
<dt>ElementTree</dt>
<dd>A built-in Python library used to parse XML data.
</dd>
<dt>JSON</dt>
<dd>JavaScript Object Notation - A format that allows for the markup of structured data based on the syntax of JavaScript Objects.
</dd>
<dt>SOA</dt>
<dd>Service-Oriented Architecture - When an application is made of components connected across a network.
</dd>
<dt>XML</dt>
<dd>eXtensible Markup Language - A format that allows for the markup of structured data.
</dd>
</dl>
<h2 id="application-1-google-geocoding-web-service">Application 1: Google geocoding web service</h2>
<p>  </p>
<p>Google has an excellent web service that allows us to make use of their large database of geographic information. We can submit a geographical search string like “Ann Arbor, MI” to their geocoding API and have Google return its best guess as to where on a map we might find our search string and tell us about the landmarks nearby.</p>
<p>The geocoding service is free but rate limited so you cannot make unlimited use of the API in a commercial application. But if you have some survey data where an end user has entered a location in a free-format input box, you can use this API to clean up your data quite nicely.</p>
<p><em>When you are using a free API like Google’s geocoding API, you need to be respectful in your use of these resources. If too many people abuse the service, Google might drop or significantly curtail its free service.</em></p>
<p></p>
<p>You can read the online documentation for this service, but it is quite simple and you can even test it using a browser by typing the following URL into your browser:</p>
<p><a href="http://maps.googleapis.com/maps/api/geocode/json?address=Ann+Arbor%2C+MI">http://maps.googleapis.com/maps/api/geocode/json?address=Ann+Arbor%2C+MI</a></p>
<p>Make sure to unwrap the URL and remove any spaces from the URL before pasting it into your browser.</p>
<p>The following is a simple application to prompt the user for a search string, call the Google geocoding API, and extract information from the returned JSON.</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error
import json
import ssl

api_key = False
# If you have a Google Places API key, enter it here
# api_key = &#39;AIzaSy___IDByT70&#39;
# https://developers.google.com/maps/documentation/geocoding/intro

if api_key is False:
    api_key = 42
    serviceurl = &#39;http://py4e-data.dr-chuck.net/json?&#39;
else :
    serviceurl = &#39;https://maps.googleapis.com/maps/api/geocode/json?&#39;

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    address = input(&#39;Enter location: &#39;)
    if len(address) &lt; 1: break

    parms = dict()
    parms[&#39;address&#39;] = address
    if api_key is not False: parms[&#39;key&#39;] = api_key
    url = serviceurl + urllib.parse.urlencode(parms)

    print(&#39;Retrieving&#39;, url)
    uh = urllib.request.urlopen(url, context=ctx)
    data = uh.read().decode()
    print(&#39;Retrieved&#39;, len(data), &#39;characters&#39;)

    try:
        js = json.loads(data)
    except:
        js = None

    if not js or &#39;status&#39; not in js or js[&#39;status&#39;] != &#39;OK&#39;:
        print(&#39;==== Failure To Retrieve ====&#39;)
        print(data)
        continue

    print(json.dumps(js, indent=4))

    lat = js[&#39;results&#39;][0][&#39;geometry&#39;][&#39;location&#39;][&#39;lat&#39;]
    lng = js[&#39;results&#39;][0][&#39;geometry&#39;][&#39;location&#39;][&#39;lng&#39;]
    print(&#39;lat&#39;, lat, &#39;lng&#39;, lng)
    location = js[&#39;results&#39;][0][&#39;formatted_address&#39;]
    print(location)

# Code: http://www.py4e.com/code3/geojson.py</code></pre>
<p>The program takes the search string and constructs a URL with the search string as a properly encoded parameter and then uses <code>urllib</code> to retrieve the text from the Google geocoding API. Unlike a fixed web page, the data we get depends on the parameters we send and the geographical data stored in Google’s servers.</p>
<p>Once we retrieve the JSON data, we parse it with the <code>json</code> library and do a few checks to make sure that we received good data, then extract the information that we are looking for.</p>
<p>The output of the program is as follows (some of the returned JSON has been removed):</p>
<pre><code>$ python3 geojson.py
Enter location: Ann Arbor, MI
Retrieving http://py4e-data.dr-chuck.net/json?address=Ann+Arbor%2C+MI&amp;key=42
Retrieved 1736 characters</code></pre>
<pre class="json"><code>{
    &quot;results&quot;: [
        {
            &quot;address_components&quot;: [
                {
                    &quot;long_name&quot;: &quot;Ann Arbor&quot;,
                    &quot;short_name&quot;: &quot;Ann Arbor&quot;,
                    &quot;types&quot;: [
                        &quot;locality&quot;,
                        &quot;political&quot;
                    ]
                },
                {
                    &quot;long_name&quot;: &quot;Washtenaw County&quot;,
                    &quot;short_name&quot;: &quot;Washtenaw County&quot;,
                    &quot;types&quot;: [
                        &quot;administrative_area_level_2&quot;,
                        &quot;political&quot;
                    ]
                },
                {
                    &quot;long_name&quot;: &quot;Michigan&quot;,
                    &quot;short_name&quot;: &quot;MI&quot;,
                    &quot;types&quot;: [
                        &quot;administrative_area_level_1&quot;,
                        &quot;political&quot;
                    ]
                },
                {
                    &quot;long_name&quot;: &quot;United States&quot;,
                    &quot;short_name&quot;: &quot;US&quot;,
                    &quot;types&quot;: [
                        &quot;country&quot;,
                        &quot;political&quot;
                    ]
                }
            ],
            &quot;formatted_address&quot;: &quot;Ann Arbor, MI, USA&quot;,
            &quot;geometry&quot;: {
                &quot;bounds&quot;: {
                    &quot;northeast&quot;: {
                        &quot;lat&quot;: 42.3239728,
                        &quot;lng&quot;: -83.6758069
                    },
                    &quot;southwest&quot;: {
                        &quot;lat&quot;: 42.222668,
                        &quot;lng&quot;: -83.799572
                    }
                },
                &quot;location&quot;: {
                    &quot;lat&quot;: 42.2808256,
                    &quot;lng&quot;: -83.7430378
                },
                &quot;location_type&quot;: &quot;APPROXIMATE&quot;,
                &quot;viewport&quot;: {
                    &quot;northeast&quot;: {
                        &quot;lat&quot;: 42.3239728,
                        &quot;lng&quot;: -83.6758069
                    },
                    &quot;southwest&quot;: {
                        &quot;lat&quot;: 42.222668,
                        &quot;lng&quot;: -83.799572
                    }
                }
            },
            &quot;place_id&quot;: &quot;ChIJMx9D1A2wPIgR4rXIhkb5Cds&quot;,
            &quot;types&quot;: [
                &quot;locality&quot;,
                &quot;political&quot;
            ]
        }
    ],
    &quot;status&quot;: &quot;OK&quot;
}
lat 42.2808256 lng -83.7430378
Ann Arbor, MI, USA</code></pre>
<pre><code>Enter location:</code></pre>
<p>You can download <a href="http://www.py4e.com/code3/geoxml.py">www.py4e.com/code3/geoxml.py</a> to explore the XML variant of the Google geocoding API.</p>
<p><strong>Exercise 1: Change either</strong> <a href="http://www.py4e.com/code3/geojson.py"><strong>geojson.py</strong></a> <strong>or</strong> <a href="http://www.py4e.com/code3/geoxml.py"><strong>geoxml.py</strong></a> <strong>to print out the two-character country code from the retrieved data. Add error checking so your program does not traceback if the country code is not there. Once you have it working, search for “Atlantic Ocean” and make sure it can handle locations that are not in any country.</strong></p>
<h2 id="application-2-twitter">Application 2: Twitter</h2>
<p>As the Twitter API became increasingly valuable, Twitter went from an open and public API to an API that required the use of OAuth signatures on each API request.</p>
<p>For this next sample program, download the files <em>twurl.py</em>, <em>hidden.py</em>, <em>oauth.py</em>, and <em>twitter1.py</em> from <a href="http://www.py4e.com/code3">www.py4e.com/code</a> and put them all in a folder on your computer.</p>
<p>To make use of these programs you will need to have a Twitter account, and authorize your Python code as an application, set up a key, secret, token and token secret. You will edit the file <em>hidden.py</em> and put these four strings into the appropriate variables in the file:</p>
<pre class="python"><code># Keep this file separate

# https://apps.twitter.com/
# Create new App and get the four strings

def oauth():
    return {&quot;consumer_key&quot;: &quot;h7Lu...Ng&quot;,
            &quot;consumer_secret&quot;: &quot;dNKenAC3New...mmn7Q&quot;,
            &quot;token_key&quot;: &quot;10185562-eibxCp9n2...P4GEQQOSGI&quot;,
            &quot;token_secret&quot;: &quot;H0ycCFemmC4wyf1...qoIpBo&quot;}

# Code: http://www.py4e.com/code3/hidden.py</code></pre>
<p>The Twitter web service are accessed using a URL like this:</p>
<p><a href="https://api.twitter.com/1.1/statuses/user_timeline.json" class="uri">https://api.twitter.com/1.1/statuses/user_timeline.json</a></p>
<p>But once all of the security information has been added, the URL will look more like:</p>
<pre><code>https://api.twitter.com/1.1/statuses/user_timeline.json?count=2
&amp;oauth_version=1.0&amp;oauth_token=101...SGI&amp;screen_name=drchuck
&amp;oauth_nonce=09239679&amp;oauth_timestamp=1380395644
&amp;oauth_signature=rLK...BoD&amp;oauth_consumer_key=h7Lu...GNg
&amp;oauth_signature_method=HMAC-SHA1</code></pre>
<p>You can read the OAuth specification if you want to know more about the meaning of the various parameters that are added to meet the security requirements of OAuth.</p>
<p>For the programs we run with Twitter, we hide all the complexity in the files <em>oauth.py</em> and <em>twurl.py</em>. We simply set the secrets in <em>hidden.py</em> and then send the desired URL to the <em>twurl.augment()</em> function and the library code adds all the necessary parameters to the URL for us.</p>
<p>This program retrieves the timeline for a particular Twitter user and returns it to us in JSON format in a string. We simply print the first 250 characters of the string:</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error
import twurl
import ssl

# https://apps.twitter.com/
# Create App and get the four strings, put them in hidden.py

TWITTER_URL = &#39;https://api.twitter.com/1.1/statuses/user_timeline.json&#39;

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    print(&#39;&#39;)
    acct = input(&#39;Enter Twitter Account:&#39;)
    if (len(acct) &lt; 1): break
    url = twurl.augment(TWITTER_URL,
                        {&#39;screen_name&#39;: acct, &#39;count&#39;: &#39;2&#39;})
    print(&#39;Retrieving&#39;, url)
    connection = urllib.request.urlopen(url, context=ctx)
    data = connection.read().decode()
    print(data[:250])
    headers = dict(connection.getheaders())
    # print headers
    print(&#39;Remaining&#39;, headers[&#39;x-rate-limit-remaining&#39;])

# Code: http://www.py4e.com/code3/twitter1.py</code></pre>
<p>When the program runs it produces the following output:</p>
<pre><code>Enter Twitter Account:drchuck
Retrieving https://api.twitter.com/1.1/ ...
[{&quot;created_at&quot;:&quot;Sat Sep 28 17:30:25 +0000 2013&quot;,&quot;
id&quot;:384007200990982144,&quot;id_str&quot;:&quot;384007200990982144&quot;,
&quot;text&quot;:&quot;RT @fixpert: See how the Dutch handle traffic
intersections: http:\/\/t.co\/tIiVWtEhj4\n#brilliant&quot;,
&quot;source&quot;:&quot;web&quot;,&quot;truncated&quot;:false,&quot;in_rep
Remaining 178

Enter Twitter Account:fixpert
Retrieving https://api.twitter.com/1.1/ ...
[{&quot;created_at&quot;:&quot;Sat Sep 28 18:03:56 +0000 2013&quot;,
&quot;id&quot;:384015634108919808,&quot;id_str&quot;:&quot;384015634108919808&quot;,
&quot;text&quot;:&quot;3 months after my freak bocce ball accident,
my wedding ring fits again! :)\n\nhttps:\/\/t.co\/2XmHPx7kgX&quot;,
&quot;source&quot;:&quot;web&quot;,&quot;truncated&quot;:false,
Remaining 177

Enter Twitter Account:</code></pre>
<p>Along with the returned timeline data, Twitter also returns metadata about the request in the HTTP response headers. One header in particular, <code>x-rate-limit-remaining</code>, informs us how many more requests we can make before we will be shut off for a short time period. You can see that our remaining retrievals drop by one each time we make a request to the API.</p>
<p>In the following example, we retrieve a user’s Twitter friends, parse the returned JSON, and extract some of the information about the friends. We also dump the JSON after parsing and “pretty-print” it with an indent of four characters to allow us to pore through the data when we want to extract more fields.</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error
import twurl
import json
import ssl

# https://apps.twitter.com/
# Create App and get the four strings, put them in hidden.py

TWITTER_URL = &#39;https://api.twitter.com/1.1/friends/list.json&#39;

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    print(&#39;&#39;)
    acct = input(&#39;Enter Twitter Account:&#39;)
    if (len(acct) &lt; 1): break
    url = twurl.augment(TWITTER_URL,
                        {&#39;screen_name&#39;: acct, &#39;count&#39;: &#39;5&#39;})
    print(&#39;Retrieving&#39;, url)
    connection = urllib.request.urlopen(url, context=ctx)
    data = connection.read().decode()

    js = json.loads(data)
    print(json.dumps(js, indent=2))

    headers = dict(connection.getheaders())
    print(&#39;Remaining&#39;, headers[&#39;x-rate-limit-remaining&#39;])

    for u in js[&#39;users&#39;]:
        print(u[&#39;screen_name&#39;])
        if &#39;status&#39; not in u:
            print(&#39;   * No status found&#39;)
            continue
        s = u[&#39;status&#39;][&#39;text&#39;]
        print(&#39;  &#39;, s[:50])

# Code: http://www.py4e.com/code3/twitter2.py</code></pre>
<p>Since the JSON becomes a set of nested Python lists and dictionaries, we can use a combination of the index operation and <code>for</code> loops to wander through the returned data structures with very little Python code.</p>
<p>The output of the program looks as follows (some of the data items are shortened to fit on the page):</p>
<pre><code>Enter Twitter Account:drchuck
Retrieving https://api.twitter.com/1.1/friends ...
Remaining 14</code></pre>
<pre class="json"><code>{
  &quot;next_cursor&quot;: 1444171224491980205,
  &quot;users&quot;: [
    {
      &quot;id&quot;: 662433,
      &quot;followers_count&quot;: 28725,
      &quot;status&quot;: {
        &quot;text&quot;: &quot;@jazzychad I just bought one .__.&quot;,
        &quot;created_at&quot;: &quot;Fri Sep 20 08:36:34 +0000 2013&quot;,
        &quot;retweeted&quot;: false,
      },
      &quot;location&quot;: &quot;San Francisco, California&quot;,
      &quot;screen_name&quot;: &quot;leahculver&quot;,
      &quot;name&quot;: &quot;Leah Culver&quot;,
    },
    {
      &quot;id&quot;: 40426722,
      &quot;followers_count&quot;: 2635,
      &quot;status&quot;: {
        &quot;text&quot;: &quot;RT @WSJ: Big employers like Google ...&quot;,
        &quot;created_at&quot;: &quot;Sat Sep 28 19:36:37 +0000 2013&quot;,
      },
      &quot;location&quot;: &quot;Victoria Canada&quot;,
      &quot;screen_name&quot;: &quot;_valeriei&quot;,
      &quot;name&quot;: &quot;Valerie Irvine&quot;,
    }
  ],
 &quot;next_cursor_str&quot;: &quot;1444171224491980205&quot;
}</code></pre>
<pre><code>leahculver
   @jazzychad I just bought one .__.
_valeriei
   RT @WSJ: Big employers like Google, AT&amp;amp;T are h
ericbollens
   RT @lukew: sneak peek: my LONG take on the good &amp;a
halherzog
   Learning Objects is 10. We had a cake with the LO,
scweeker
   @DeviceLabDC love it! Now where so I get that &quot;etc

Enter Twitter Account:</code></pre>
<p>The last bit of the output is where we see the for loop reading the five most recent “friends” of the <em><span class="citation" data-cites="drchuck">@drchuck</span></em> Twitter account and printing the most recent status for each friend. There is a great deal more data available in the returned JSON. If you look in the output of the program, you can also see that the “find the friends” of a particular account has a different rate limitation than the number of timeline queries we are allowed to run per time period.</p>
<p>These secure API keys allow Twitter to have solid confidence that they know who is using their API and data and at what level. The rate-limiting approach allows us to do simple, personal data retrievals but does not allow us to build a product that pulls data from their API millions of times per day.</p>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
