// Native Javascript for Bootstrap 3 | Collapse
// by dnp_theme

(function(factory){

  // CommonJS/RequireJS and "native" compatibility
  if(typeof module !== "undefined" && typeof exports == "object") {
    // A commonJS/RequireJS environment
    if(typeof window != "undefined") {
      // Window and document exist, so return the factory's return value.
      module.exports = factory();
    } else {
      // Let the user give the factory a Window and Document.
      module.exports = factory;
    }
  } else {
    // Assume a traditional browser.
    window.Collapse = factory();
  }

})(function(){

  // COLLAPSE DEFINITION
  // ===================
  var Collapse = function( element, options ) {
    options = options || {};
    this.isIE = (new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})").exec(navigator.userAgent) != null) ? parseFloat( RegExp.$1 ) : false;
    this.btn = typeof element === 'object' ? element : document.querySelector(element);
    this.accordion = null;
    this.collapse = null;
    this.duration = 300; // default collapse transition duration
    this.options = {};
    this.options.duration = (this.isIE && this.isIE < 10) ? 0 : (options.duration || this.duration);
    this.init();
  };

  // COLLAPSE METHODS
  // ================
  Collapse.prototype = {

    init : function() {
      this.actions();
      this.addEvent();
      this.collapse = this.getTarget();
      this.accordion = this.btn.getAttribute('data-parent')
        && this.getClosest(this.btn, this.btn.getAttribute('data-parent'));
    },

    actions : function() {
      var self = this;
      var getOuterHeight = function (el) {
        var s = el && (el.currentStyle || window.getComputedStyle(el)), // the getComputedStyle polyfill would do this for us, but we want to make sure it does
          btp = /px/.test(s.borderTopWidth) ? Math.round(s.borderTopWidth.replace('px','')) : 0,
          mtp = /px/.test(s.marginTop)  ? Math.round(s.marginTop.replace('px',''))    : 0,
          mbp = /px/.test(s.marginBottom)  ? Math.round(s.marginBottom.replace('px',''))  : 0,
          mte = /em/.test(s.marginTop)  ? Math.round(s.marginTop.replace('em','')    * parseInt(s.fontSize)) : 0,
          mbe = /em/.test(s.marginBottom)  ? Math.round(s.marginBottom.replace('em','')  * parseInt(s.fontSize)) : 0;
        return el.clientHeight + parseInt( btp ) + parseInt( mtp ) + parseInt( mbp ) + parseInt( mte ) + parseInt( mbe ); //we need an accurate margin value
      };

      this.toggle = function(e) {
        e.preventDefault();

        if (!/\bin/.test(self.collapse.className)) {
          self.open();
        } else {
          self.close();
        }
      },
      this.close = function() {
        self._close(self.collapse);
        self.addClass(self.btn,'collapsed');
      },
      this.open = function() {
        self._open(self.collapse);
        self.removeClass(self.btn,'collapsed');

        if ( self.accordion !== null ) {
          var active = self.accordion.querySelectorAll('.collapse.in'), al = active.length, i = 0;
          for (i;i<al;i++) {
            if ( active[i] !== self.collapse) self._close(active[i]);
          }
        }
      },
      this._open = function(c) {
        self.removeEvent();
        self.addClass(c,'in');
        c.setAttribute('aria-expanded','true');
        self.addClass(c,'collapsing');
        setTimeout(function() {
          c.style.height = self.getMaxHeight(c) + 'px'
          c.style.overflowY = 'hidden';
        }, 0);
        setTimeout(function() {
          c.style.height = '';
          c.style.overflowY = '';
          self.removeClass(c,'collapsing');
          self.addEvent();
        }, self.options.duration);
      },
      this._close = function(c) {
        self.removeEvent();
        c.setAttribute('aria-expanded','false');
        c.style.height = self.getMaxHeight(c) + 'px'
        setTimeout(function() {
          c.style.height = '0px';
          c.style.overflowY = 'hidden';
          self.addClass(c,'collapsing');
        }, 0);

        setTimeout(function() {
          self.removeClass(c,'collapsing');
          self.removeClass(c,'in');
          c.style.overflowY = '';
          c.style.height = '';
          self.addEvent();
        }, self.options.duration);
      },
      this.getMaxHeight = function(l) { // get collapse trueHeight and border
        var h = 0;
        for (var k = 0, ll = l.children.length; k < ll; k++) {
          h += getOuterHeight(l.children[k]);
        }
        return h;
      },
      this.removeEvent = function() {
        this.btn.removeEventListener('click', this.toggle, false);
      },
      this.addEvent = function() {
        this.btn.addEventListener('click', this.toggle, false);
      },
      this.getTarget = function() {
        var t = this.btn,
          h = t.href && t.getAttribute('href').replace('#',''),
          d = t.getAttribute('data-target') && ( t.getAttribute('data-target') ),
          id = h || ( d && /#/.test(d)) && d.replace('#',''),
          cl = (d && d.charAt(0) === '.') && d, //the navbar collapse trigger targets a class
          c = id && document.getElementById(id) || cl && document.querySelector(cl);
        return c;
      },

      this.getClosest = function (el, s) { //el is the element and s the selector of the closest item to find
      // source http://gomakethings.com/climbing-up-and-down-the-dom-tree-with-vanilla-javascript/
        var f = s.charAt(0);
        for ( ; el && el !== document; el = el.parentNode ) {// Get closest match
          if ( f === '.' ) {// If selector is a class
            if ( document.querySelector(s) !== undefined ) { return el; }
          }
          if ( f === '#' ) { // If selector is an ID
            if ( el.id === s.substr(1) ) { return el; }
          }
        }
        return false;
      };
      this.addClass = function(el,c) {
        if (el.classList) { el.classList.add(c); } else { el.className += ' '+c; }
      };
      this.removeClass = function(el,c) {
        if (el.classList) { el.classList.remove(c); } else { el.className = el.className.replace(c,'').replace(/^\s+|\s+$/g,''); }
      };
    }
  };

  // COLLAPSE DATA API
  // =================
  var Collapses = document.querySelectorAll('[data-toggle="collapse"]'), i = 0, cll = Collapses.length;
  for (i;i<cll;i++) {
    var item = Collapses[i], options = {};
    options.duration = item.getAttribute('data-duration');
    new Collapse(item,options);
  }

  return Collapse;

});

(function(){

    var headertext = [],
    headers = document.querySelectorAll(".table-stack th"),
    tablerows = document.querySelectorAll(".table-stack tr"),
    tablebody = document.querySelector(".table-stack tbody");

    if(!headers || !tablerows || !tablebody) {
      return;
    }
    for(var i = 0; i < headers.length; i++) {
      var current = headers[i];
      headertext.push(current.textContent.replace(/\r?\n|\r/,""));
    }
    for (var i = 0, row; row = tablebody.rows[i]; i++) {
      for (var j = 0, col; col = row.cells[j]; j++) {
        col.setAttribute("data-heading", headertext[j]);
				col.setAttribute("title", headertext[j]);
      }
    }



}());

// Native Javascript for Bootstrap 3 | Tab
// by dnp_theme

(function(factory){

  // CommonJS/RequireJS and "native" compatibility
  if(typeof module !== "undefined" && typeof exports == "object") {
    // A commonJS/RequireJS environment
    if(typeof window != "undefined") {
      // Window and document exist, so return the factory's return value.
      module.exports = factory();
    } else {
      // Let the user give the factory a Window and Document.
      module.exports = factory;
    }
  } else {
    // Assume a traditional browser.
    window.Tab = factory();
  }

})(function(){

  // TAB DEFINITION
  // ===================
  var Tab = function( element,options ) {
    options = options || {};
    this.isIE = (new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})").exec(navigator.userAgent) != null) ? parseFloat( RegExp.$1 ) : false;
    this.tab = typeof element === 'object' ? element : document.querySelector(element);
    this.tabs = this.tab.parentNode.parentNode;
    this.dropdown = this.tabs.querySelector('.dropdown');
    if ( /\bdropdown-menu/.test(this.tabs.className) ) {
      this.dropdown = this.tabs.parentNode;
      this.tabs = this.tabs.parentNode.parentNode;
    }
    this.options = options;

    // default tab transition duration
    this.duration = 150;
    this.options.duration = (this.isIE && this.isIE < 10)  ? 0 : (options.duration || this.duration);
    this.init();
  }

  // TAB METHODS
  // ================
  Tab.prototype = {

    init : function() {
      this.actions();
      this.tab.addEventListener('click', this.action, false);
    },

    actions : function() {
      var self = this;

      this.action = function(e) {
        e = e || window.e; e.preventDefault();
        var next = e.target; //the tab we clicked is now the next tab
        var nextContent = document.getElementById(next.getAttribute('href').replace('#','')); //this is the actual object, the next tab content to activate
        var isDropDown = new RegExp('(?:^|\\s)'+ 'dropdown-menu' +'(?!\\S)');

        // get current active tab and content
        var activeTab = self.getActiveTab();
        var activeContent = self.getActiveContent();

        if ( !/\bactive/.test(next.parentNode.className) ) {
          // toggle "active" class name
          self.removeClass(activeTab,'active');
          self.addClass(next.parentNode,'active');

          // handle dropdown menu "active" class name
          if ( self.dropdown ) {
            if ( !(isDropDown.test(self.tab.parentNode.parentNode.className)) ) {
              if (/\bactive/.test(self.dropdown.className)) self.removeClass(self.dropdown,'active');
            } else {
              if (!/\bactive/.test(self.dropdown.className)) self.addClass(self.dropdown,'active');
            }
          }

          //1. hide current active content first
          self.removeClass(activeContent,'in');

          setTimeout(function() {
            //2. toggle current active content from view
            self.removeClass(activeContent,'active');
            self.addClass(nextContent,'active');
          }, self.options.duration);
          setTimeout(function() {
            //3. show next active content
            self.addClass(nextContent,'in');
          }, self.options.duration*2);
        }
      },
      this.addClass = function(el,c) {
        if (el.classList) { el.classList.add(c); } else { el.className += ' '+c; }
      },
      this.removeClass = function(el,c) {
        if (el.classList) { el.classList.remove(c); } else { el.className = el.className.replace(c,'').replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,''); }
      },
      this.getActiveTab = function() {
        var activeTabs = this.tabs.querySelectorAll('.active');
        if ( activeTabs.length === 1 && !/\bdropdown/.test(activeTabs[0].className) ) {
          return activeTabs[0]
        } else if ( activeTabs.length > 1 ) {
          return activeTabs[activeTabs.length-1]
        }
      },
      this.getActiveContent = function() {
        var a = this.getActiveTab().getElementsByTagName('a')[0].getAttribute('href').replace('#','');
        return a && document.getElementById(a)
      }
    }
  }


  // TAB DATA API
  // =================
  var Tabs = document.querySelectorAll("[data-toggle='tab'], [data-toggle='pill']"), tbl = Tabs.length, i=0;
  for ( i;i<tbl;i++ ) {
    var tab = Tabs[i], options = {};
    options.duration = tab.getAttribute('data-duration') && tab.getAttribute('data-duration') || false;
    new Tab(tab,options);
  }

  return Tab;

});

(function (window) {
    'use strict';

    var extendObj = function (src, target) {
        for (var prop in target) {
            if (target.hasOwnProperty(prop) && target[prop]) {
                src[prop] = target[prop];
            }
        }

        return src;
    };

    var getHeaders = function (selector, scope) {
        var ret = [];
        var target = document.querySelectorAll(scope);

        Array.prototype.forEach.call(target, function (elem) {
            var elems = elem.querySelectorAll(selector);
            ret = ret.concat(Array.prototype.slice.call(elems));
        });

        return ret;
    };

    var getLevel = function (header) {
        if (typeof header !== 'string') {
            return 0;
        }

        var decs = header.match(/\d/g);
        return decs ? Math.min.apply(null, decs) : 1;
    };

    var createList = function (wrapper, count) {
        while (count--) {
            wrapper = wrapper.appendChild(
                document.createElement('ul')
            );

            if (count) {
                wrapper = wrapper.appendChild(
                    document.createElement('li')
                );
            }
        }

        return wrapper;
    };

    var jumpBack = function (currentWrapper, offset) {
        while (offset--) {
            currentWrapper = currentWrapper.parentElement;
        }

        return currentWrapper;
    };

    var setAttrs = function (overwrite, prefix) {
        return function (src, target, index) {
            var content = src.textContent;
            var pre = prefix + '-' + index;
            target.textContent = content;

            var id = overwrite ? pre : (src.id || pre);

            id = encodeURIComponent(id);

            src.id = id;
            target.href = '#' + id;
        };
    };

    var buildTOC = function (options) {
        var selector = options.selector;
        var scope = options.scope;

        var ret = document.createElement('ol');
        var wrapper = ret;
        var lastLi = null;

        var _setAttrs = setAttrs(options.overwrite, options.prefix);

        getHeaders(selector, scope).reduce(function (prev, cur, index) {
            var currentLevel = getLevel(cur.tagName);
            var offset = currentLevel - prev;

            if (offset > 0) {
                wrapper = createList(lastLi, offset);
            }

            if (offset < 0) {
                wrapper = jumpBack(wrapper, -offset * 2);
            }

            wrapper = wrapper || ret;

            var li = document.createElement('li');
            var a = document.createElement('a');

            _setAttrs(cur, a, index);

            wrapper.appendChild(li).appendChild(a);

            lastLi = li;

            return currentLevel;
        }, getLevel(selector));

        return ret;
    };

    var initTOC = function (options) {
        var defaultOpts = {
            selector: 'h1, h2, h3, h4, h5, h6',
            scope: 'body',
            overwrite: false,
            prefix: 'toc'
        };

        options = extendObj(defaultOpts, options);

        var selector = options.selector;

        if (typeof selector !== 'string') {
            throw new TypeError('selector must be a string');
        }

        if (!selector.match(/^(?:h[1-6],?\s*)+$/g)) {
            throw new TypeError('selector must contains only h1-6');
        }

        var currentHash = location.hash;

        if (currentHash) {
            // fix hash
            setTimeout(function () {
                location.hash = '';
                location.hash = currentHash;
            }, 0);
        }

        return buildTOC(options);
    };

    if (typeof define === 'function' && define.amd) {
        define(function () {
            return initTOC;
        });
    } else {
        window.initTOC = initTOC;
    }
}(window));
