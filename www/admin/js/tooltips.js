addLoadListener(initTooltips);
//addLoadListener(initToggleStatus);
addLoadListener(initRowHighlight);
addLoadListener(initViewImages);

function initViewImages(){
	if (document.getElementById("addImage")) {
		var a_collection = document.getElementById("addImage").getElementsByTagName("A");
		for (var i = 0; i < a_collection.length; i++) {
			a_collection[i].onclick = function(){
				window.open(this.href, 'image', 'width=600, height=300, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, copyhistory=yes, resizable=yes');
				return false;
			}
		}
	}
}



/*var toggle_li_collection = null;

function toggleStatus(trigger, type){
	for (var i = 0; i < toggle_li_collection.length; i++){
		var obj = toggle_li_collection[i];
		if (obj.className.match(type)) {
			if (obj.style.display == "none") {
				obj.style.display = "block";
				trigger.className = "";
			} else {
				obj.style.display = "none";
				trigger.className = "selected";
			}
		}
	}
}

function initToggleStatus(){
	
	toggle_li_collection = document.getElementById("centercontent").getElementsByTagName("LI");
	
	var expired = document.getElementById("toggle_expired");
	if (expired) {
		expired.onclick = function(){
			toggleStatus(this, 'expired');
		}
	}
	
	var pending = document.getElementById("toggle_pending");
	if (pending) {
		pending.onclick = function(){
			toggleStatus(this, 'pending');
		}
	}
}*/

function initRowHighlight() {
	var table = document.getElementById("itemlist");
	if (table) {
		var tr_collection = table.getElementsByTagName("TBODY")[0].getElementsByTagName("TR");
		if (tr_collection.length > 1) {
			for (var i = 0; i < tr_collection.length; i++) {
				var tr = tr_collection[i];
				
				tr.onmouseover = function(){
					if (!this.className.match(" hover")) {
						this.className += " hover";
					}
				};
				
				tr.onmouseout = function(){
					if (this.className.match(" hover")) {
						this.className = this.className.replace(" hover", "");
					}
				};
				
				/*tr_collection[i].onmouseover = function(){
					this.style.border = "1px solid red";	
				}*/
			}
		}
	}
}

function initTooltips()
{
  var tips = getElementsByAttribute("class", "hastooltip");

  for (var i = 0; i < tips.length; i++)
  {
    attachEventListener(tips[i], "click", showTip, false);
    //attachEventListener(tips[i], "mouseout", hideTip, false);
  }

  return true;
}

function showTip(event)
{
  if (typeof event == "undefined")
  {
    event = window.event;
  }
  //alert('event is ');
  //alert('Event is ' . event);
  //alert('--');
  //exit;
  
  var target = getEventTarget(event);

  while (target.className == null || !/(^| )hastooltip( |$)/.test(target.className))
  {
    target = target.parentNode;
  }
  
  theHiddenBit=target.parentNode.getElementsByTagName('div')[0];

 //alert('target is '  + target.innerHTML);
 
 
 switch(target.innerHTML){
  
  case ('More...'):
    
        theHiddenBit.className='';
        target.innerHTML='Hide...';
  break

  case ('Hide...'):
       theHiddenBit.className='optional';
      target.innerHTML='More...';
  break

  case 'Add Child...':
    theHiddenBit.className='';
    target.innerHTML='';
  break

 }
  
// alert(target.innerHTML);


/*
  var tip = document.createElement("div");
  var content = target.getAttribute("title");

  target.tooltip = tip;
  target.setAttribute("title", "");

  if (target.getAttribute("id") != "")
  {
    tip.setAttribute("id", target.getAttribute("id") + "tooltip");
  }

  tip.className = "tooltip";
  tip.appendChild(document.createTextNode(content));

  var scrollingPosition = getScrollingPosition();
  var cursorPosition = [0, 0];

  if (typeof event.pageX != "undefined" && typeof event.x != "undefined")
  {
    cursorPosition[0] = event.pageX;
    cursorPosition[1] = event.pageY;
  }
  else
  {
    cursorPosition[0] = event.clientX + scrollingPosition[0];
    cursorPosition[1] = event.clientY + scrollingPosition[1];
  }

  tip.style.position = "absolute";
  tip.style.left = cursorPosition[0] + 10 + "px";
  tip.style.top = cursorPosition[1] + 10 + "px";
  document.getElementsByTagName("body")[0].appendChild(tip);
*/
  return false;
}

function hideTip(event)
{
  if (typeof event == "undefined")
  {
    event = window.event;
  }

  var target = getEventTarget(event);

  while (target.className == null || !target.className.match(/(^| )hastooltip( |$)/))
  {
    target = target.parentNode;
  }

  if (target.tooltip != null)
  {
    target.setAttribute("title", target.tooltip.childNodes[0].nodeValue);
    target.tooltip.parentNode.removeChild(target.tooltip);
  }

  return false;
}

function addLoadListener(fn)
{
  if (typeof window.addEventListener != 'undefined')
  {
    window.addEventListener('load', fn, false);
  }
  else if (typeof document.addEventListener != 'undefined')
  {
    document.addEventListener('load', fn, false);
  }
  else if (typeof window.attachEvent != 'undefined')
  {
    window.attachEvent('onload', fn);
  }
  else
  {
    var oldfn = window.onload;
    if (typeof window.onload != 'function')
    {
      window.onload = fn;
    }
    else
    {
      window.onload = function()
      {
        oldfn();
        fn();
      };
    }
  }
}

function attachEventListener(target, eventType, functionRef, capture)
{
  if (typeof target.addEventListener != "undefined")
  {
    target.addEventListener(eventType, functionRef, capture);
  }
  else if (typeof target.attachEvent != "undefined")
  {
    target.attachEvent("on" + eventType, functionRef);
  }
  else
  {
    eventType = "on" + eventType;

    if (typeof target[eventType] == "function")
    {
      var oldListener = target[eventType];

      target[eventType] = function()
      {
        oldListener();

        return functionRef();
      }
    }
    else
    {
      target[eventType] = functionRef;
    }
  }

  return true;
}

function getEventTarget(event)
{
  var targetElement = null;

  if (typeof event.target != "undefined")
  {
    targetElement = event.target;
  }
  else
  {
    targetElement = event.srcElement;
  }

  while (targetElement.nodeType == 3 && targetElement.parentNode != null)
  {
    targetElement = targetElement.parentNode;
  }

  return targetElement;
}

function getScrollingPosition()
{
  //array for X and Y scroll position
  var position = [0, 0];

  //if the window.pageYOffset property is supported
  if(typeof window.pageYOffset != 'undefined')
  {
    //store position values
    position = [
        window.pageXOffset,
        window.pageYOffset
    ];
  }

  //if the documentElement.scrollTop property is supported
  //and the value is greater than zero
  if(typeof document.documentElement.scrollTop != 'undefined'
    && document.documentElement.scrollTop > 0)
  {
    //store position values
    position = [
        document.documentElement.scrollLeft,
        document.documentElement.scrollTop
    ];
  }

  //if the body.scrollTop property is supported
  else if(typeof document.body.scrollTop != 'undefined')
  {
    //store position values
    position = [
        document.body.scrollLeft,
        document.body.scrollTop
    ];
  }

  //return the array
  return position;
}

function getElementsByAttribute(attribute, attributeValue)
{
  var elementArray = new Array();
  var matchedArray = new Array();

  if (document.all)
  {
    elementArray = document.all;
  }
  else
  {
    elementArray = document.getElementsByTagName("*");
  }

  for (var i = 0; i < elementArray.length; i++)
  {
    if (attribute == "class")
    {
      var pattern = new RegExp("(^| )" + attributeValue + "( |$)");

      if (elementArray[i].className.match(pattern))
      {
        matchedArray[matchedArray.length] = elementArray[i];
      }
    }
    else if (attribute == "for")
    {
      if (elementArray[i].getAttribute("htmlFor") || elementArray[i].getAttribute("for"))
      {
        if (elementArray[i].htmlFor == attributeValue)
        {
          matchedArray[matchedArray.length] = elementArray[i];
        }
      }
    }
    else if (elementArray[i].getAttribute(attribute) == attributeValue)
    {
      matchedArray[matchedArray.length] = elementArray[i];
    }
  }

  return matchedArray;
}