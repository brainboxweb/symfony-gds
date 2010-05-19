addLoadListener(initTooltips);

function initTooltips()
{
  var tips = document.forms;

  for (var i = 0; i < tips.length; i++)
  {
    attachEventListener(tips[i], "submit", validate, false);
    
  }

  return true;
}

function validate(event)
{
  //alert('here'); 
  if (typeof event == "undefined")
  {
    event = window.event;
  }

  var target = getEventTarget(event);
  
  //alert(target.id);
  
  var elements = target.elements;
  var emailPattern = /^[\w\.\-]+@([\w\-]+\.)+[a-zA-Z]+$/;
  var URLpattern = /^[a-zA-Z0-9-]+$/;

  for (var i = 0; i < elements.length; i++)
  {
    if (/(^| )checkRequired( |$)/.test(elements[i].className) && elements[i].value == "")
    {
      elements[i].focus();
      alert("Please fill out this field.");
      event.preventDefault(); // DOM style
      return false;
    
    }
    if (/(^| )checkURL( |$)/.test(elements[i].className) && !URLpattern.test(elements[i].value))
    {
      elements[i].focus();
      alert("Letters, number and dashes only for this field.");
      event.preventDefault(); // DOM style
      return false;
    }

    if (/(^| )checkEmail( |$)/.test(elements[i].className) && !emailPattern.test(elements[i].value))
    {
      elements[i].focus();
      alert("Please fill in a valid e-mail address.");
      event.preventDefault(); // DOM style
      return false;
    }
  }
 
  return true;
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