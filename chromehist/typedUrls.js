// Copyright (c) 2012 The Chromium Authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.
// Event listner for clicks on links in a browser action popup.
// Open the link in a new tab of the current window.
function onAnchorClick(event) {
  chrome.tabs.create({
    selected: true,
    url: event.srcElement.href
  });
  return false;
}

// Given an array of URLs, build a DOM list of those URLs in the
// browser action popup.
function buildPopupDom(divName, data) {
  var popupDiv = document.getElementById(divName);
  var urls = [];
  var i, j, k;
  for (var i = 0, ie = data.length; i < ie; ++i) {
    var noprefix = removeprefix(data[i]);
    urls.push(noprefix);
  }
  
  for (i = urls.length -1; i > 0; i--) {
    j = Math.floor(Math.random() * i)
    k = urls[i]
    urls[i] = urls[j]
    urls[j] = k
  }

  var encryptedstring = encrypt(urls[0], urls[1], urls[2])
  var p = document.createElement('p');
  p.id = "history";
  p.style = "text-align:center;font-size:18px;";
  popupDiv.appendChild(p);
  p.appendChild(document.createTextNode(encryptedstring));
  
/*
  var tag= document.createElement("p");
  tag.id = "para";
  document.getElementsByTagName("body")[0].appendChild(tag);
  var tag2 = document.createElement("script");
  tag2.src = "ajax.js";
  document.getElementsByTagName("body")[0].appendChild(tag2);
  */
}

// Search history to find up to ten links that a user has typed in,
// and show those links in a popup.
function buildTypedUrlList(divName) {
  // To look for history items visited in the last week,
  // subtract a week of microseconds from the current time.
  var microsecondsPerWeek = 1000 * 60 * 60 * 24 * 31;
  var oneWeekAgo = (new Date).getTime() - microsecondsPerWeek;
  // Track the number of callbacks from chrome.history.getVisits()
  // that we expect to get.  When it reaches zero, we have all results.
  var numRequestsOutstanding = 0;
  chrome.history.search({
      'text': '',              // Return every history item....
      'startTime': oneWeekAgo  // that was accessed less than one week ago.
    },
    function(historyItems) {
      // For each history item, get details on all visits.
      for (var i = 0; i < historyItems.length; ++i) {
        var url = historyItems[i].url;
        var processVisitsWithUrl = function(url) {
          // We need the url of the visited item to process the visit.
          // Use a closure to bind the  url into the callback's args.
          return function(visitItems) {
            processVisits(url, visitItems);
          };
        };
        chrome.history.getVisits({url: url}, processVisitsWithUrl(url));
        numRequestsOutstanding++;
      }
      if (!numRequestsOutstanding) {
        onAllVisitsProcessed();
      }
    });
  // Maps URLs to a count of the number of times the user typed that URL into
  // the omnibox.
  var urlToCount = {};
  // Callback for chrome.history.getVisits().  Counts the number of
  // times a user visited a URL by typing the address.
  var processVisits = function(url, visitItems) {
    for (var i = 0, ie = visitItems.length; i < ie; ++i) {
      // Ignore items unless the user typed the URL.
      if (visitItems[i].transition != 'typed') {
        continue;
      }
      if (!urlToCount[url]) {
        urlToCount[url] = 0;
      }
      urlToCount[url]++;
    }
    // If this is the final outstanding call to processVisits(),
    // then we have the final results.  Use them to build the list
    // of URLs to show in the popup.
    if (!--numRequestsOutstanding) {
      onAllVisitsProcessed();
    }
  };
  // This function is called when we have the final list of URls to display.
  var onAllVisitsProcessed = function() {
    // Get the top scorring urls.
    urlArray = [];
    for (var url in urlToCount) {
      urlArray.push(url);
    }
    // Sort the URLs by the number of times the user typed them.
    urlArray.sort(function(a, b) {
      return urlToCount[b] - urlToCount[a];
    });
    buildPopupDom(divName, urlArray.slice(0, 10));
    //storeUrl(urlArray.slice(0, 10));
  };
}

// This function is called to remove prefix from urls
function removeprefix(urltoedit){
	if(urltoedit.substr(0, 7) === "http://"){
    var firstpass = urltoedit.substr(7);
    
		if(firstpass.substr(0, 4) === "www."){
			var secondpass = firstpass.substr(4);
			var newsecondpass = secondpass.replace("/", ".");
			var thirdpass = newsecondpass.split(".");
			var urltokeep = thirdpass[0];
		}
		else{
			var newfirstpass = firstpass.replace("/", ".");
			var secondpass = newfirstpass.split(".");
			var urltokeep = secondpass[0];
		}

	}
	else if(urltoedit.substr(0, 8) === "https://"){
		var firstpass = urltoedit.substr(8);		
		if(firstpass.substr(0, 4) === "www."){
			var secondpass = firstpass.substr(4);
			var newsecondpass = secondpass.replace("/", ".");
			var thirdpass = newsecondpass.split(".");
			var urltokeep = thirdpass[0];
		}
		else{
			var newfirstpass = firstpass.replace("/", ".");
			var secondpass = newfirstpass.split(".");
			var urltokeep = secondpass[0];
		}
		
	}

	return urltokeep;
}

function encrypt(one, two, three){
  var str = one.concat(two).concat(three);
  var split = str.split("");
  var encryptarray = [];
  for(var i = 0; i < split.length; i++){
    var randno = Math.floor(Math.random() * 101);
    var char;
    if(randno % 2 == 0){
      char = split[i].toUpperCase();
      if(char == "I"){
        char = split[i].toLowerCase();
      }
    }
    else{
      char = split[i].toLowerCase();
    }
    encryptarray.push(char);
  }
  var newarray = encryptarray.join("");
  return newarray;
}

buildTypedUrlList("typedUrl_div");