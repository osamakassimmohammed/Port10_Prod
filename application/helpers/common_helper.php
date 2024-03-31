<?php /** @noinspection PhpUnusedLocalVariableInspection */

if (!function_exists('Debug')) {
    /**
     * dDebug Helper
     *
     * Outputs the given variable(s) with formatting and location.
     *
     * @param mixed ...$params
     *
     * @return void
     *
     * @access public
     */
    function Debug(...$params)
    {
        list($callee) = debug_backtrace();

        // $params = func_get_args();
        // $argc = func_num_args();

        $argc = count($params);

        $displayOptions = [
            'maxDepth' => 1,
            'maxStringLength' => 160,
            'fileLinkFormat' => null,
        ];

        $extraDisplayOptions = [];

        $it = 0;

        /** @noinspection CssInvalidPropertyValue */
        /** @noinspection CssUnknownProperty */
        /** @noinspection CssOverwrittenProperties */
        $html = <<<'HTML'
<style id="exen-debug">
.exen-no-select {
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
}

.exen-hidden {
    visibility: hidden;
    display: none;
}

.exen-js-enabled pre.exen-dump .exen-dump-compact,
.exen-js-enabled .exen-dump-str-collapse .exen-dump-str-collapse,
.exen-js-enabled .exen-dump-str-expand .exen-dump-str-expand {
    display: none;
}

.exen-dump-hover:hover {
    background-color: #B729D9;
    color: #FFF !important;
    border-radius: 2px;
}

pre.exen-dump {
    display: block;
    white-space: pre;
    padding: 5px;
    overflow: initial !important;
}

pre.exen-dump:after {
    content: "";
    visibility: hidden;
    display: block;
    height: 0;
    clear: both;
}

pre.exen-dump span {
    display: inline;
}

pre.exen-dump a {
    text-decoration: none;
    cursor: pointer;
    border: 0;
    outline: none;
    color: inherit;
}

pre.exen-dump img {
    max-width: 50em;
    max-height: 50em;
    margin: .5em 0 0 0;
    padding: 0;
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAAAAAA6mKC9AAAAHUlEQVQY02O8zAABilCaiQEN0EeA8QuUcX9g3QEAAjcC5piyhyEAAAAASUVORK5CYII=) #D3D3D3;
}

pre.exen-dump .exen-dump-ellipsis {
    display: inline-block;
    overflow: visible;
    text-overflow: ellipsis;
    max-width: 5em;
    white-space: nowrap;
    overflow: hidden;
    vertical-align: top;
}

pre.exen-dump .exen-dump-ellipsis + .exen-dump-ellipsis {
    max-width: none;
}

pre.exen-dump code {
    display: inline;
    padding: 0;
    background: none;
}

.exen-dump-public.exen-dump-highlight,
.exen-dump-protected.exen-dump-highlight,
.exen-dump-private.exen-dump-highlight,
.exen-dump-str.exen-dump-highlight,
.exen-dump-key.exen-dump-highlight {
    background: rgba(111, 172, 204, 0.3);
    border: 1px solid #7DA0B1;
    border-radius: 3px;
}

.exen-dump-public.exen-dump-highlight-active,
.exen-dump-protected.exen-dump-highlight-active,
.exen-dump-private.exen-dump-highlight-active,
.exen-dump-str.exen-dump-highlight-active,
.exen-dump-key.exen-dump-highlight-active {
    background: rgba(253, 175, 0, 0.4);
    border: 1px solid #ffa500;
    border-radius: 3px;
}

pre.exen-dump .exen-dump-search-hidden {
    display: none !important;
}

pre.exen-dump .exen-dump-search-wrapper {
    font-size: 0;
    white-space: nowrap;
    margin-bottom: 5px;
    display: flex;
    position: -webkit-sticky;
    position: sticky;
    top: 5px;
}

pre.exen-dump .exen-dump-search-wrapper > * {
    vertical-align: top;
    box-sizing: border-box;
    height: 21px;
    font-weight: normal;
    border-radius: 0;
    background: #FFF;
    color: #757575;
    border: 1px solid #BBB;
}

pre.exen-dump .exen-dump-search-wrapper > input.exen-dump-search-input {
    padding: 3px;
    height: 21px;
    font-size: 12px;
    border-right: none;
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
    color: #000;
    min-width: 15px;
    width: 100%;
}

pre.exen-dump .exen-dump-search-wrapper > .exen-dump-search-input-next,
pre.exen-dump .exen-dump-search-wrapper > .exen-dump-search-input-previous {
    background: #F2F2F2;
    outline: none;
    border-left: none;
    font-size: 0;
    line-height: 0;
}

pre.exen-dump .exen-dump-search-wrapper > .exen-dump-search-input-next {
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}

pre.exen-dump .exen-dump-search-wrapper > .exen-dump-search-input-next > svg,
pre.exen-dump .exen-dump-search-wrapper > .exen-dump-search-input-previous > svg {
    pointer-events: none;
    width: 12px;
    height: 12px;
}

pre.exen-dump .exen-dump-search-wrapper > .exen-dump-search-count {
    display: inline-block;
    padding: 0 5px;
    margin: 0;
    border-left: none;
    line-height: 21px;
    font-size: 12px;
}

fieldset#one {
    background: #fefefe !important;
    border: 1px solid rgba(0, 0, 0, .1);
    padding: 0 5px 5px;
    border-radius: 3px;
    box-shadow: inset 0 -0.5em 0.5em rgba(200, 200, 200, .1),
        0 0 0 1px rgba(255, 255, 255, .5),
        0.1em 0.1em 0.5em rgba(200, 200, 200, .15);
}

legend#one {
    border: 1px solid rgba(0, 0, 0, .05);
    background: rgba(40, 160, 60, .3);
    color: rgba(0, 0, 0, .5);
    padding: 3px 5px;
    border-radius: 3px;
    font-family: "Iosevka", monospace;
    font-size: 14px;
    font-weight: 600;
    box-shadow: inset 0 -1em 1em rgba(40, 200, 40, .1),
        0 0 0 1px rgba(255, 255, 255, .5),
        0.2em 0.2em 1em rgba(40, 200, 40, .3);
}

legend#one span#colon {
    color: rgba(40, 40, 140, .2);
    font-weight: 300 !important;
}

legend#one span#colon::after {
    content: ': ';
}

legend#one span:nth-child(1) {
    font-weight: 400;
    color: rgba(0, 0, 0, .4);
}

legend#one span:nth-child(3) {
    color: rgba(0, 0, 0, .5);
}

legend#one span:nth-child(4) {
    font-weight: 400;
    color: rgba(0, 0, 0, .2);
}

legend#one span:nth-child(4)::after {
    content: ' @ ';
}

legend#one span:nth-child(5) {
    font-weight: 400;
    color: rgba(0, 0, 0, .4);
}

legend#one span:nth-child(6) {
    color: rgba(80, 160, 60, .9);
}

legend#one span:nth-child(7) {
    color: rgba(80, 160, 60, .9);
}

pre#one {
    font-family: "Iosevka", monospace;
    font-size: 14px;
    font-weight: 600;
    margin: 0 auto;
    word-wrap: break-word;
    white-space: pre-wrap;
    position: relative;
    z-index: 99999;
    word-break: break-all;
}

code#one {
    font-family: "Iosevka", monospace;
    font-size: 14px;
    font-weight: 600;
    margin: 0 auto;
    line-height: 1.2;
}

code#one div#head {
    display: inline;
    margin: 0 auto;
    /*padding: 3px;*/
    /*position: relative;*/
    /*top: -14px;*/
    opacity: .8;
}

code#one div#head span#colon {
    color: rgba(40, 40, 140, .3);
    font-weight: 300 !important;
}

code#one div#head span#colon::after {
    content: ': ';
}

code#one strong span:nth-child(1) {
    color: rgba(140, 40, 40, .75);
}

code#one strong span:nth-child(2) {
    color: rgba(40, 40, 140, .1);
}

code#one strong span:nth-child(3) {
    color: rgba(40, 40, 140, .6);
}

code#one strong span:nth-child(4) {
    color: rgba(140, 40, 40, .75);
}

code#one strong span:nth-child(5) {
    color: rgba(40, 40, 140, .5);
}

code#one span#code-content {
    font-weight: 500;
}
</style>

<script type="application/javascript" id="exen-debug">
"use strict";

let ExenDump =
    window.ExenDump ||
    (function (doc) {
        doc.documentElement.classList.add("exen-js-enabled");

        let platform = navigator.userAgent
            .split(/(\([a-zA-Z0-9_\-\s;]+\))/)[1]
            .split(" ")[1]
            .toUpperCase();

        const rxEsc = /([.*+?^${}()|\[\]\/\\])/g;
        const idRx = /\bexen-dump-\d+-ref[012]\w+\b/;
        const keyHint = 0 <= platform.indexOf("MAC") ? "Cmd" : "Ctrl";

        let addEventListener = (event, type, listener) => {
            event.addEventListener(type, listener, false);
        };

        if (!doc.addEventListener) {
            addEventListener = function (element, eventName, cb) {
                element.attachEvent("on" + eventName, function (event) {
                    event.preventDefault = function () {
                        event.returnValue = false;
                    };

                    event.target = event.srcElement;

                    cb(event);
                });
            };
        }

        const toggle = (a, recursive) => {
            let sibling = a.nextSibling || {};
            let oldClass = sibling.className;
            let arrow = null;
            let newClass = null;

            if (/\bexen-dump-compact\b/.test(oldClass)) {
                arrow = "▼";
                newClass = "exen-dump-expanded";
            } else if (/\bexen-dump-expanded\b/.test(oldClass)) {
                arrow = "▶";
                newClass = "exen-dump-compact";
            } else {
                return false;
            }

            if (doc.createEvent && sibling.dispatchEvent) {
                const event = doc.createEvent("Event");

                const eventClass =
                    "exen-dump-expanded" === newClass
                        ? "exenBeforeDumpExpand"
                        : "exenBeforeDumpCollapse";

                event.bubbles = true;
                event.cancelable = true;
                event.type = eventClass;

                sibling.dispatchEvent(event);
            }

            a.lastChild.innerHTML = arrow;

            sibling.className = sibling.className.replace(
                /\bexen-dump-(compact|expanded)\b/,
                newClass
            );

            if (recursive) {
                try {
                    a = sibling.querySelectorAll("." + oldClass);
                    for (sibling = 0; sibling < a.length; ++sibling) {
                        if (-1 === a[sibling].className.indexOf(newClass)) {
                            a[sibling].className = newClass;
                            a[
                                sibling
                                ].previousSibling.lastChild.innerHTML = arrow;
                        }
                    }
                } catch (ex) {
                    console.debug(ex);
                }
            }

            return true;
        };

        const collapse = (a, recursive) => {
            let sibling = a.nextSibling || {};
            let oldClass = sibling.className;

            if (/\bexen-dump-expanded\b/.test(oldClass)) {
                toggle(a, recursive);

                return true;
            }

            return false;
        };

        const expand = (a, recursive) => {
            let sibling = a.nextSibling || {};
            let oldClass = sibling.className;

            if (/\bexen-dump-compact\b/.test(oldClass)) {
                toggle(a, recursive);

                return true;
            }

            return false;
        };

        const collapseAll = (root) => {
            let a = root.querySelector("a.exen-dump-toggle");

            if (a) {
                collapse(a, true);
                expand(a);

                return true;
            }

            return false;
        };

        const reveal = (node) => {
            let previous,
                parents = [];

            while (
                (node = node.parentNode || {}) &&
                (previous = node.previousSibling) &&
                "A" === previous.tagName
                ) {
                parents.push(previous);
            }

            if (0 !== parents.length) {
                parents.forEach(function (parent) {
                    expand(parent);
                });

                return true;
            }

            return false;
        };

        const highlight = (root, activeNode, nodes) => {
            resetHighlightedNodes(root);

            Array.from(nodes || []).forEach(function (node) {
                if (!/\bexen-dump-highlight\b/.test(node.className)) {
                    node.className = node.className + " exen-dump-highlight";
                }
            });

            if (!/\bexen-dump-highlight-active\b/.test(activeNode.className)) {
                activeNode.className =
                    activeNode.className + " exen-dump-highlight-active";
            }
        };

        const resetHighlightedNodes = (root) => {
            Array.from(
                root.querySelectorAll(
                    ".exen-dump-str, .exen-dump-key, .exen-dump-public, .exen-dump-protected, .exen-dump-private"
                )
            ).forEach(function (strNode) {
                strNode.className = strNode.className.replace(
                    /\bexen-dump-highlight\b/,
                    ""
                );
                strNode.className = strNode.className.replace(
                    /\bexen-dump-highlight-active\b/,
                    ""
                );
            });
        };

        return function (root, x) {
            root = doc.getElementById(root);

            let indentRx = new RegExp(
                    "^(" +
                    (root.getAttribute("data-indent-pad") || "  ").replace(
                        rxEsc,
                        "\\$1"
                    ) +
                    ")+",
                    "m"
                ),
                options = {
                    $options,
                },
                elt = root.getElementsByTagName("A"),
                len = elt.length,
                it = 0,
                s,
                h,
                t = [];

            while (it < len) t.push(elt[it++]);

            for (it in x) options[it] = x[it];

            function a(event, f) {
                addEventListener(root, event, function (event, n) {
                    if ("A" === event.target.tagName) {
                        f(event.target, event);
                    } else if ("A" === event.target.parentNode.tagName) {
                        f(event.target.parentNode, event);
                    } else {
                        n = /\bexen-dump-ellipsis\b/.test(
                            event.target.className
                        )
                            ? event.target.parentNode
                            : event.target;

                        if ((n = n.nextElementSibling) && "A" === n.tagName) {
                            if (!/\bexen-dump-toggle\b/.test(n.className)) {
                                n = n.nextElementSibling || n;
                            }

                            f(n, event, true);
                        }
                    }
                });
            }

            const isCtrlKey = (event) => event.ctrlKey || event.metaKey;

            const xpathString = (str) => {
                let parts = str.match(/[^'"]+|['"]/g).map(function (part) {
                    if ("'" === part) {
                        return '"\'"';
                    }

                    if ('"' === part) {
                        return "'\"'";
                    }

                    return "'" + part + "'";
                });

                return "concat(" + parts.join(",") + ", '')";
            };

            const xpathHasClass = (className) =>
                "contains(concat(' ', normalize-space(@class), ' '), ' " +
                className +
                " ')";

            a("mouseover", function (a, event, c) {
                if (c) {
                    event.target.style.cursor = "pointer";
                }
            });

            a("click", function (a, event, c) {
                if (/\bexen-dump-toggle\b/.test(a.className)) {
                    event.preventDefault();

                    if (!toggle(a, isCtrlKey(event))) {
                        let r = doc.getElementById(
                                a.getAttribute("href").slice(1)
                            ),
                            s = r.previousSibling,
                            f = r.parentNode,
                            t = a.parentNode;

                        t.replaceChild(r, a);
                        f.replaceChild(a, s);
                        t.insertBefore(s, r);

                        f = f.firstChild.nodeValue.match(indentRx);
                        t = t.firstChild.nodeValue.match(indentRx);

                        if (f && t && f[0] !== t[0]) {
                            r.innerHTML = r.innerHTML.replace(
                                new RegExp(
                                    "^" + f[0].replace(rxEsc, "\\$1"),
                                    "mg"
                                ),
                                t[0]
                            );
                        }

                        if (/\bexen-dump-compact\b/.test(r.className)) {
                            toggle(s, isCtrlKey(event));
                        }
                    }

                    if (c) {
                        console.debug("Exen");
                    } else if (doc.getSelection) {
                        try {
                            doc.getSelection().removeAllRanges();
                        } catch (ex) {
                            doc.getSelection().empty();

                            console.debug(ex);
                        }
                    } else {
                        doc.selection.empty();
                    }
                } else if (/\bexen-dump-str-toggle\b/.test(a.className)) {
                    event.preventDefault();
                    event = a.parentNode.parentNode;
                    event.className = event.className.replace(
                        /\bexen-dump-str-(expand|collapse)\b/,
                        a.parentNode.className
                    );
                }
            });

            elt = root.getElementsByTagName("SAMP");
            len = elt.length;
            it = 0;

            while (it < len) t.push(elt[it++]);

            len = t.length;

            for (it = 0; it < len; ++it) {
                elt = t[it];

                if ("SAMP" === elt.tagName) {
                    a = elt.previousSibling || {};

                    if ("A" !== a.tagName) {
                        a = doc.createElement("A");
                        a.className = "exen-dump-ref";
                        elt.parentNode.insertBefore(a, elt);
                    } else {
                        a.innerHTML += " ";
                    }

                    a.title =
                        (a.title ? a.title + "\n[" : "[") +
                        keyHint +
                        "+click] Expand all children";
                    a.innerHTML +=
                        elt.className === "exen-dump-compact"
                            ? "<span>▶</span>"
                            : "<span>▼</span>";
                    a.className += " exen-dump-toggle";

                    x = 1;

                    if ("exen-dump" !== elt.parentNode.className) {
                        x += elt.parentNode.getAttribute("data-depth") / 1;
                    }
                } else if (
                    /\bexen-dump-ref\b/.test(elt.className) &&
                    (a = elt.getAttribute("href"))
                ) {
                    a = a.slice(1);

                    elt.className += " exen-dump-hover";
                    elt.className += " " + a;

                    if (/[\[{]$/.test(elt.previousSibling.nodeValue)) {
                        a = a !== elt.nextSibling.id && doc.getElementById(a);

                        try {
                            s = a.nextSibling;
                            elt.appendChild(a);
                            s.parentNode.insertBefore(a, s);

                            if (/^[@#]/.test(elt.innerHTML)) {
                                elt.innerHTML += " <span>▶</span>";
                            } else {
                                elt.innerHTML = "<span>▶</span>";
                                elt.className = "exen-dump-ref";
                            }

                            elt.className += " exen-dump-toggle";
                        } catch (ex) {
                            if ("&" === elt.innerHTML.charAt(0)) {
                                elt.innerHTML = "…";
                                elt.className = "exen-dump-ref";
                            }

                            console.debug(ex);
                        }
                    }
                }
            }

            if (doc.evaluate && Array.from && root.children.length > 1) {
                root.setAttribute("tabindex", "0");

                const SearchState = function () {
                    this.nodes = [];
                    this.idx = 0;
                };

                SearchState.prototype = {
                    next: function () {
                        if (this.isEmpty()) {
                            return this.current();
                        }

                        this.idx =
                            this.idx < this.nodes.length - 1 ? this.idx + 1 : 0;

                        return this.current();
                    },
                    previous: function () {
                        if (this.isEmpty()) {
                            return this.current();
                        }

                        this.idx =
                            this.idx > 0 ? this.idx - 1 : this.nodes.length - 1;

                        return this.current();
                    },
                    isEmpty: function () {
                        return 0 === this.count();
                    },
                    current: function () {
                        if (this.isEmpty()) {
                            return null;
                        }

                        return this.nodes[this.idx];
                    },
                    reset: function () {
                        this.nodes = [];
                        this.idx = 0;
                    },
                    count: function () {
                        return this.nodes.length;
                    },
                };

                function showCurrent(state) {
                    let currentNode = state.current(),
                        currentRect,
                        searchRect;

                    if (currentNode) {
                        reveal(currentNode);
                        highlight(root, currentNode, state.nodes);

                        if ("scrollIntoView" in currentNode) {
                            currentNode.scrollIntoView(true);
                            currentRect = currentNode.getBoundingClientRect();
                            searchRect = search.getBoundingClientRect();

                            if (
                                currentRect.top <
                                searchRect.top + searchRect.height
                            ) {
                                window.scrollBy(
                                    0,
                                    -(searchRect.top + searchRect.height + 5)
                                );
                            }
                        }
                    }

                    counter.textContent =
                        (state.isEmpty() ? 0 : state.idx + 1) +
                        " of " +
                        state.count();
                }

                let search = doc.createElement("div");

                search.className =
                    "exen-dump-search-wrapper exen-dump-search-hidden";

                search.innerHTML =
                    '<input type="text" class="exen-dump-search-input">' +
                    '<span class="exen-dump-search-count">0 of 0</span>' +
                    '<button type="button" class="exen-dump-search-input-previous" tabindex="-1">' +
                    '<svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 1331l-166 165q-19 19-45 19t-45-19L896 965l-531 531q-19 19-45 19t-45-19l-166-165q-19-19-19-45.5t19-45.5l742-741q19-19 45-19t45 19l742 741q19 19 19 45.5t-19 45.5z"/></svg>' +
                    "</button>" +
                    '<button type="button" class="exen-dump-search-input-next" tabindex="-1">' +
                    '<svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 808l-742 741q-19 19-45 19t-45-19L109 808q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"/></svg>' +
                    "</button>";

                root.insertBefore(search, root.firstChild);

                let state = new SearchState();
                let searchInput = search.querySelector(
                    ".exen-dump-search-input"
                );
                let counter = search.querySelector(".exen-dump-search-count");
                let searchInputTimer = 0;
                let previousSearchQuery = "";

                addEventListener(searchInput, "keyup", function (event) {
                    let searchQuery = event.target.value;

                    /* Don't perform anything if the pressed key didn't change the query */
                    if (searchQuery === previousSearchQuery) {
                        return;
                    }

                    previousSearchQuery = searchQuery;

                    clearTimeout(searchInputTimer);

                    searchInputTimer = setTimeout(function () {
                        state.reset();
                        collapseAll(root);
                        resetHighlightedNodes(root);

                        if ("" === searchQuery) {
                            counter.textContent = "0 of 0";

                            return;
                        }

                        let classMatches = [
                            "exen-dump-str",
                            "exen-dump-key",
                            "exen-dump-public",
                            "exen-dump-protected",
                            "exen-dump-private",
                        ]
                            .map(xpathHasClass)
                            .join(" or ");

                        let xpathResult = doc.evaluate(
                            ".//span[" +
                            classMatches +
                            "][contains(translate(child::text(), " +
                            xpathString(searchQuery.toUpperCase()) +
                            ", " +
                            xpathString(searchQuery.toLowerCase()) +
                            "), " +
                            xpathString(searchQuery.toLowerCase()) +
                            ")]",
                            root,
                            null,
                            XPathResult.ORDERED_NODE_ITERATOR_TYPE,
                            null
                        );

                        let node = null;

                        while ((node = xpathResult.iterateNext()))
                            state.nodes.push(node);

                        showCurrent(state);
                    }, 400);
                });

                Array.from(
                    search.querySelectorAll(
                        ".exen-dump-search-input-next, .exen-dump-search-input-previous"
                    )
                ).forEach(function (btn) {
                    addEventListener(btn, "click", function (event) {
                        event.preventDefault() - 1 !==
                        event.target.className.indexOf("next")
                            ? state.next()
                            : state.previous();
                        searchInput.focus();
                        collapseAll(root);
                        showCurrent(state);
                    });
                });

                addEventListener(root, "keydown", function (event) {
                    let isSearchActive = !/\bexen-dump-search-hidden\b/.test(
                        search.className
                    );

                    if (
                        (114 === event.keyCode && !isSearchActive) ||
                        (isCtrlKey(event) && 70 === event.keyCode)
                    ) {
                        /* F3 or CMD/CTRL + F */
                        if (
                            70 === event.keyCode &&
                            document.activeElement === searchInput
                        ) {
                            /*
                             * If CMD/CTRL + F is hit while having focus on search input,
                             * the user probably meant to trigger browser search instead.
                             * Let the browser execute its behavior:
                             */
                            return;
                        }

                        event.preventDefault();
                        search.className = search.className.replace(
                            /\bexen-dump-search-hidden\b/,
                            ""
                        );
                        searchInput.focus();
                    } else if (isSearchActive) {
                        if (27 === event.keyCode) {
                            /* ESC key */
                            search.className += " exen-dump-search-hidden";
                            event.preventDefault();
                            resetHighlightedNodes(root);
                            searchInput.value = "";
                        } else if (
                            (isCtrlKey(event) &&
                                71 === event.keyCode) /* CMD/CTRL + G */ ||
                            13 === event.keyCode /* Enter */ ||
                            114 === event.keyCode /* F3 */
                        ) {
                            event.preventDefault();
                            event.shiftKey ? state.previous() : state.next();
                            collapseAll(root);
                            showCurrent(state);
                        }
                    }
                });
            }

            if (0 >= options.maxStringLength) return;

            try {
                elt = root.querySelectorAll(".exen-dump-str");
                len = elt.length;
                it = 0;
                t = [];

                while (it < len) t.push(elt[it++]);

                len = t.length;

                for (it = 0; it < len; ++it) {
                    elt = t[it];
                    s = elt.innerText || elt.textContent;
                    x = s.length - options.maxStringLength;

                    if (0 < x) {
                        h = elt.innerHTML;
                        elt[elt.innerText ? "innerText" : "textContent"] = s.substring(0, options.maxStringLength);
                        elt.className += " exen-dump-str-collapse";
                        elt.innerHTML =
                            "<span class=exen-dump-str-collapse>" +
                            h +
                            '<a class="exen-dump-ref exen-dump-str-toggle" title="Collapse"> ◀</a></span>' +
                            "<span class=exen-dump-str-expand>" +
                            elt.innerHTML +
                            '<a class="exen-dump-ref exen-dump-str-toggle" title="' +
                            x +
                            ' remaining characters"> ▶</a></span>';
                    }
                }
            } catch (ex) {
                console.debug(ex);
            }
        };
    })(document);
HTML;

        $html = str_replace('{$options}', json_encode($displayOptions, JSON_FORCE_OBJECT), $html);

        $html = preg_replace('/\s+/', ' ', $html) . '</script>' . PHP_EOL;

        echo $html;

        echo '<div id="exen-debug">' . PHP_EOL;
        echo '    <fieldset id="one">' . PHP_EOL;
        echo '        <legend id="one">' . PHP_EOL;
        echo '            <span class="exen-no-select">FILE</span>' . '<span id="colon"></span>' . '<span>' . $callee['file'] . '</span>' . '<span></span>' . '<span class="exen-no-select">LINE</span>' . '<span id="colon"></span>' . '<span>' . $callee['line'] . '</span>' . PHP_EOL;
        echo '        </legend>' . PHP_EOL;
        echo '        <pre id="one" class="exen-dump">' . PHP_EOL;
        echo '            <code id="one">' . PHP_EOL;

        foreach ($params as $param) {
            echo '<div id="head">' . '<strong><span class="exen-no-select">Debug</span><span class="exen-no-select"> #</span>' . '<span>' . ++$it . '</span>' . '<span class="exen-no-select"> of </span>' . '<span>' . $argc . '</span>' . '</strong>' . '<span id="colon"></span>' . '</div>' . PHP_EOL . PHP_EOL;
            // echo '<br/>' . PHP_EOL;
            echo '<span id="code-content">' . PHP_EOL;
            @var_dump($param);
            echo '</span>' . PHP_EOL;
        }

        echo '            </code>' . PHP_EOL;
        echo '        </pre>' . PHP_EOL;
        echo '    </fieldset>' . PHP_EOL;
        echo '<div>' . PHP_EOL;
        echo '<br class="exen-no-select">' . PHP_EOL;
    }
}

if (!function_exists('DDebug')) {
    /**
     * dDebug Helper
     *
     * Outputs the given variable(s) with formatting and location.
     *
     * @param mixed ...$params
     *
     * @return void
     *
     * @access public
     */
    function DDebug(...$params)
    {
        list($callee) = debug_backtrace();

        // $params = func_get_args();
        // $argc = func_num_args();

        $argc = count($params);

        $displayOptions = [
            'maxDepth' => 1,
            'maxStringLength' => 160,
            'fileLinkFormat' => null,
        ];

        $extraDisplayOptions = [];

        $it = 0;

        /** @noinspection CssInvalidPropertyValue */
        /** @noinspection CssUnknownProperty */
        /** @noinspection CssOverwrittenProperties */
        $html = <<<'HTML'
<style id="exen-debug">
.exen-no-select {
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
}

.exen-hidden {
    visibility: hidden;
    display: none;
}

.exen-js-enabled pre.exen-dump .exen-dump-compact,
.exen-js-enabled .exen-dump-str-collapse .exen-dump-str-collapse,
.exen-js-enabled .exen-dump-str-expand .exen-dump-str-expand {
    display: none;
}

.exen-dump-hover:hover {
    background-color: #B729D9;
    color: #FFF !important;
    border-radius: 2px;
}

pre.exen-dump {
    display: block;
    white-space: pre;
    padding: 5px;
    overflow: initial !important;
}

pre.exen-dump:after {
    content: "";
    visibility: hidden;
    display: block;
    height: 0;
    clear: both;
}

pre.exen-dump span {
    display: inline;
}

pre.exen-dump a {
    text-decoration: none;
    cursor: pointer;
    border: 0;
    outline: none;
    color: inherit;
}

pre.exen-dump img {
    max-width: 50em;
    max-height: 50em;
    margin: .5em 0 0 0;
    padding: 0;
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAAAAAA6mKC9AAAAHUlEQVQY02O8zAABilCaiQEN0EeA8QuUcX9g3QEAAjcC5piyhyEAAAAASUVORK5CYII=) #D3D3D3;
}

pre.exen-dump .exen-dump-ellipsis {
    display: inline-block;
    overflow: visible;
    text-overflow: ellipsis;
    max-width: 5em;
    white-space: nowrap;
    overflow: hidden;
    vertical-align: top;
}

pre.exen-dump .exen-dump-ellipsis + .exen-dump-ellipsis {
    max-width: none;
}

pre.exen-dump code {
    display: inline;
    padding: 0;
    background: none;
}

.exen-dump-public.exen-dump-highlight,
.exen-dump-protected.exen-dump-highlight,
.exen-dump-private.exen-dump-highlight,
.exen-dump-str.exen-dump-highlight,
.exen-dump-key.exen-dump-highlight {
    background: rgba(111, 172, 204, 0.3);
    border: 1px solid #7DA0B1;
    border-radius: 3px;
}

.exen-dump-public.exen-dump-highlight-active,
.exen-dump-protected.exen-dump-highlight-active,
.exen-dump-private.exen-dump-highlight-active,
.exen-dump-str.exen-dump-highlight-active,
.exen-dump-key.exen-dump-highlight-active {
    background: rgba(253, 175, 0, 0.4);
    border: 1px solid #ffa500;
    border-radius: 3px;
}

pre.exen-dump .exen-dump-search-hidden {
    display: none !important;
}

pre.exen-dump .exen-dump-search-wrapper {
    font-size: 0;
    white-space: nowrap;
    margin-bottom: 5px;
    display: flex;
    position: -webkit-sticky;
    position: sticky;
    top: 5px;
}

pre.exen-dump .exen-dump-search-wrapper > * {
    vertical-align: top;
    box-sizing: border-box;
    height: 21px;
    font-weight: normal;
    border-radius: 0;
    background: #FFF;
    color: #757575;
    border: 1px solid #BBB;
}

pre.exen-dump .exen-dump-search-wrapper > input.exen-dump-search-input {
    padding: 3px;
    height: 21px;
    font-size: 12px;
    border-right: none;
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
    color: #000;
    min-width: 15px;
    width: 100%;
}

pre.exen-dump .exen-dump-search-wrapper > .exen-dump-search-input-next,
pre.exen-dump .exen-dump-search-wrapper > .exen-dump-search-input-previous {
    background: #F2F2F2;
    outline: none;
    border-left: none;
    font-size: 0;
    line-height: 0;
}

pre.exen-dump .exen-dump-search-wrapper > .exen-dump-search-input-next {
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}

pre.exen-dump .exen-dump-search-wrapper > .exen-dump-search-input-next > svg,
pre.exen-dump .exen-dump-search-wrapper > .exen-dump-search-input-previous > svg {
    pointer-events: none;
    width: 12px;
    height: 12px;
}

pre.exen-dump .exen-dump-search-wrapper > .exen-dump-search-count {
    display: inline-block;
    padding: 0 5px;
    margin: 0;
    border-left: none;
    line-height: 21px;
    font-size: 12px;
}

fieldset#one {
    background: #fefefe !important;
    border: 1px solid rgba(0, 0, 0, .1);
    padding: 0 5px 5px;
    border-radius: 3px;
    box-shadow: inset 0 -0.5em 0.5em rgba(200, 200, 200, .1),
        0 0 0 1px rgba(255, 255, 255, .5),
        0.1em 0.1em 0.5em rgba(200, 200, 200, .15);
}

legend#one {
    border: 1px solid rgba(0, 0, 0, .05);
    background: rgba(40, 160, 60, .3);
    color: rgba(0, 0, 0, .5);
    padding: 3px 5px;
    border-radius: 3px;
    font-family: "Iosevka", monospace;
    font-size: 14px;
    font-weight: 600;
    box-shadow: inset 0 -1em 1em rgba(40, 200, 40, .1),
        0 0 0 1px rgba(255, 255, 255, .5),
        0.2em 0.2em 1em rgba(40, 200, 40, .3);
}

legend#one span#colon {
    color: rgba(40, 40, 140, .2);
    font-weight: 300 !important;
}

legend#one span#colon::after {
    content: ': ';
}

legend#one span:nth-child(1) {
    font-weight: 400;
    color: rgba(0, 0, 0, .4);
}

legend#one span:nth-child(3) {
    color: rgba(0, 0, 0, .5);
}

legend#one span:nth-child(4) {
    font-weight: 400;
    color: rgba(0, 0, 0, .2);
}

legend#one span:nth-child(4)::after {
    content: ' @ ';
}

legend#one span:nth-child(5) {
    font-weight: 400;
    color: rgba(0, 0, 0, .4);
}

legend#one span:nth-child(6) {
    color: rgba(80, 160, 60, .9);
}

legend#one span:nth-child(7) {
    color: rgba(80, 160, 60, .9);
}

pre#one {
    font-family: "Iosevka", monospace;
    font-size: 14px;
    font-weight: 600;
    margin: 0 auto;
    word-wrap: break-word;
    white-space: pre-wrap;
    position: relative;
    z-index: 99999;
    word-break: break-all;
}

code#one {
    font-family: "Iosevka", monospace;
    font-size: 14px;
    font-weight: 600;
    margin: 0 auto;
    line-height: 1.2;
}

code#one div#head {
    display: inline;
    margin: 0 auto;
    /*padding: 3px;*/
    /*position: relative;*/
    /*top: -14px;*/
    opacity: .8;
}

code#one div#head span#colon {
    color: rgba(40, 40, 140, .3);
    font-weight: 300 !important;
}

code#one div#head span#colon::after {
    content: ': ';
}

code#one strong span:nth-child(1) {
    color: rgba(140, 40, 40, .75);
}

code#one strong span:nth-child(2) {
    color: rgba(40, 40, 140, .1);
}

code#one strong span:nth-child(3) {
    color: rgba(40, 40, 140, .6);
}

code#one strong span:nth-child(4) {
    color: rgba(140, 40, 40, .75);
}

code#one strong span:nth-child(5) {
    color: rgba(40, 40, 140, .5);
}

code#one span#code-content {
    font-weight: 500;
}
</style>

<script type="application/javascript" id="exen-debug">
"use strict";

let ExenDump =
    window.ExenDump ||
    (function (doc) {
        doc.documentElement.classList.add("exen-js-enabled");

        let platform = navigator.userAgent
            .split(/(\([a-zA-Z0-9_\-\s;]+\))/)[1]
            .split(" ")[1]
            .toUpperCase();

        const rxEsc = /([.*+?^${}()|\[\]\/\\])/g;
        const idRx = /\bexen-dump-\d+-ref[012]\w+\b/;
        const keyHint = 0 <= platform.indexOf("MAC") ? "Cmd" : "Ctrl";

        let addEventListener = (event, type, listener) => {
            event.addEventListener(type, listener, false);
        };

        if (!doc.addEventListener) {
            addEventListener = function (element, eventName, cb) {
                element.attachEvent("on" + eventName, function (event) {
                    event.preventDefault = function () {
                        event.returnValue = false;
                    };

                    event.target = event.srcElement;

                    cb(event);
                });
            };
        }

        const toggle = (a, recursive) => {
            let sibling = a.nextSibling || {};
            let oldClass = sibling.className;
            let arrow = null;
            let newClass = null;

            if (/\bexen-dump-compact\b/.test(oldClass)) {
                arrow = "▼";
                newClass = "exen-dump-expanded";
            } else if (/\bexen-dump-expanded\b/.test(oldClass)) {
                arrow = "▶";
                newClass = "exen-dump-compact";
            } else {
                return false;
            }

            if (doc.createEvent && sibling.dispatchEvent) {
                const event = doc.createEvent("Event");

                const eventClass =
                    "exen-dump-expanded" === newClass
                        ? "exenBeforeDumpExpand"
                        : "exenBeforeDumpCollapse";

                event.bubbles = true;
                event.cancelable = true;
                event.type = eventClass;

                sibling.dispatchEvent(event);
            }

            a.lastChild.innerHTML = arrow;

            sibling.className = sibling.className.replace(
                /\bexen-dump-(compact|expanded)\b/,
                newClass
            );

            if (recursive) {
                try {
                    a = sibling.querySelectorAll("." + oldClass);
                    for (sibling = 0; sibling < a.length; ++sibling) {
                        if (-1 === a[sibling].className.indexOf(newClass)) {
                            a[sibling].className = newClass;
                            a[
                                sibling
                                ].previousSibling.lastChild.innerHTML = arrow;
                        }
                    }
                } catch (ex) {
                    console.debug(ex);
                }
            }

            return true;
        };

        const collapse = (a, recursive) => {
            let sibling = a.nextSibling || {};
            let oldClass = sibling.className;

            if (/\bexen-dump-expanded\b/.test(oldClass)) {
                toggle(a, recursive);

                return true;
            }

            return false;
        };

        const expand = (a, recursive) => {
            let sibling = a.nextSibling || {};
            let oldClass = sibling.className;

            if (/\bexen-dump-compact\b/.test(oldClass)) {
                toggle(a, recursive);

                return true;
            }

            return false;
        };

        const collapseAll = (root) => {
            let a = root.querySelector("a.exen-dump-toggle");

            if (a) {
                collapse(a, true);
                expand(a);

                return true;
            }

            return false;
        };

        const reveal = (node) => {
            let previous,
                parents = [];

            while (
                (node = node.parentNode || {}) &&
                (previous = node.previousSibling) &&
                "A" === previous.tagName
                ) {
                parents.push(previous);
            }

            if (0 !== parents.length) {
                parents.forEach(function (parent) {
                    expand(parent);
                });

                return true;
            }

            return false;
        };

        const highlight = (root, activeNode, nodes) => {
            resetHighlightedNodes(root);

            Array.from(nodes || []).forEach(function (node) {
                if (!/\bexen-dump-highlight\b/.test(node.className)) {
                    node.className = node.className + " exen-dump-highlight";
                }
            });

            if (!/\bexen-dump-highlight-active\b/.test(activeNode.className)) {
                activeNode.className =
                    activeNode.className + " exen-dump-highlight-active";
            }
        };

        const resetHighlightedNodes = (root) => {
            Array.from(
                root.querySelectorAll(
                    ".exen-dump-str, .exen-dump-key, .exen-dump-public, .exen-dump-protected, .exen-dump-private"
                )
            ).forEach(function (strNode) {
                strNode.className = strNode.className.replace(
                    /\bexen-dump-highlight\b/,
                    ""
                );
                strNode.className = strNode.className.replace(
                    /\bexen-dump-highlight-active\b/,
                    ""
                );
            });
        };

        return function (root, x) {
            root = doc.getElementById(root);

            let indentRx = new RegExp(
                    "^(" +
                    (root.getAttribute("data-indent-pad") || "  ").replace(
                        rxEsc,
                        "\\$1"
                    ) +
                    ")+",
                    "m"
                ),
                options = {
                    $options,
                },
                elt = root.getElementsByTagName("A"),
                len = elt.length,
                it = 0,
                s,
                h,
                t = [];

            while (it < len) t.push(elt[it++]);

            for (it in x) options[it] = x[it];

            function a(event, f) {
                addEventListener(root, event, function (event, n) {
                    if ("A" === event.target.tagName) {
                        f(event.target, event);
                    } else if ("A" === event.target.parentNode.tagName) {
                        f(event.target.parentNode, event);
                    } else {
                        n = /\bexen-dump-ellipsis\b/.test(
                            event.target.className
                        )
                            ? event.target.parentNode
                            : event.target;

                        if ((n = n.nextElementSibling) && "A" === n.tagName) {
                            if (!/\bexen-dump-toggle\b/.test(n.className)) {
                                n = n.nextElementSibling || n;
                            }

                            f(n, event, true);
                        }
                    }
                });
            }

            const isCtrlKey = (event) => event.ctrlKey || event.metaKey;

            const xpathString = (str) => {
                let parts = str.match(/[^'"]+|['"]/g).map(function (part) {
                    if ("'" === part) {
                        return '"\'"';
                    }

                    if ('"' === part) {
                        return "'\"'";
                    }

                    return "'" + part + "'";
                });

                return "concat(" + parts.join(",") + ", '')";
            };

            const xpathHasClass = (className) =>
                "contains(concat(' ', normalize-space(@class), ' '), ' " +
                className +
                " ')";

            a("mouseover", function (a, event, c) {
                if (c) {
                    event.target.style.cursor = "pointer";
                }
            });

            a("click", function (a, event, c) {
                if (/\bexen-dump-toggle\b/.test(a.className)) {
                    event.preventDefault();

                    if (!toggle(a, isCtrlKey(event))) {
                        let r = doc.getElementById(
                                a.getAttribute("href").slice(1)
                            ),
                            s = r.previousSibling,
                            f = r.parentNode,
                            t = a.parentNode;

                        t.replaceChild(r, a);
                        f.replaceChild(a, s);
                        t.insertBefore(s, r);

                        f = f.firstChild.nodeValue.match(indentRx);
                        t = t.firstChild.nodeValue.match(indentRx);

                        if (f && t && f[0] !== t[0]) {
                            r.innerHTML = r.innerHTML.replace(
                                new RegExp(
                                    "^" + f[0].replace(rxEsc, "\\$1"),
                                    "mg"
                                ),
                                t[0]
                            );
                        }

                        if (/\bexen-dump-compact\b/.test(r.className)) {
                            toggle(s, isCtrlKey(event));
                        }
                    }

                    if (c) {
                        console.debug("Exen");
                    } else if (doc.getSelection) {
                        try {
                            doc.getSelection().removeAllRanges();
                        } catch (ex) {
                            doc.getSelection().empty();

                            console.debug(ex);
                        }
                    } else {
                        doc.selection.empty();
                    }
                } else if (/\bexen-dump-str-toggle\b/.test(a.className)) {
                    event.preventDefault();
                    event = a.parentNode.parentNode;
                    event.className = event.className.replace(
                        /\bexen-dump-str-(expand|collapse)\b/,
                        a.parentNode.className
                    );
                }
            });

            elt = root.getElementsByTagName("SAMP");
            len = elt.length;
            it = 0;

            while (it < len) t.push(elt[it++]);

            len = t.length;

            for (it = 0; it < len; ++it) {
                elt = t[it];

                if ("SAMP" === elt.tagName) {
                    a = elt.previousSibling || {};

                    if ("A" !== a.tagName) {
                        a = doc.createElement("A");
                        a.className = "exen-dump-ref";
                        elt.parentNode.insertBefore(a, elt);
                    } else {
                        a.innerHTML += " ";
                    }

                    a.title =
                        (a.title ? a.title + "\n[" : "[") +
                        keyHint +
                        "+click] Expand all children";
                    a.innerHTML +=
                        elt.className === "exen-dump-compact"
                            ? "<span>▶</span>"
                            : "<span>▼</span>";
                    a.className += " exen-dump-toggle";

                    x = 1;

                    if ("exen-dump" !== elt.parentNode.className) {
                        x += elt.parentNode.getAttribute("data-depth") / 1;
                    }
                } else if (
                    /\bexen-dump-ref\b/.test(elt.className) &&
                    (a = elt.getAttribute("href"))
                ) {
                    a = a.slice(1);

                    elt.className += " exen-dump-hover";
                    elt.className += " " + a;

                    if (/[\[{]$/.test(elt.previousSibling.nodeValue)) {
                        a = a !== elt.nextSibling.id && doc.getElementById(a);

                        try {
                            s = a.nextSibling;
                            elt.appendChild(a);
                            s.parentNode.insertBefore(a, s);

                            if (/^[@#]/.test(elt.innerHTML)) {
                                elt.innerHTML += " <span>▶</span>";
                            } else {
                                elt.innerHTML = "<span>▶</span>";
                                elt.className = "exen-dump-ref";
                            }

                            elt.className += " exen-dump-toggle";
                        } catch (ex) {
                            if ("&" === elt.innerHTML.charAt(0)) {
                                elt.innerHTML = "…";
                                elt.className = "exen-dump-ref";
                            }

                            console.debug(ex);
                        }
                    }
                }
            }

            if (doc.evaluate && Array.from && root.children.length > 1) {
                root.setAttribute("tabindex", "0");

                const SearchState = function () {
                    this.nodes = [];
                    this.idx = 0;
                };

                SearchState.prototype = {
                    next: function () {
                        if (this.isEmpty()) {
                            return this.current();
                        }

                        this.idx =
                            this.idx < this.nodes.length - 1 ? this.idx + 1 : 0;

                        return this.current();
                    },
                    previous: function () {
                        if (this.isEmpty()) {
                            return this.current();
                        }

                        this.idx =
                            this.idx > 0 ? this.idx - 1 : this.nodes.length - 1;

                        return this.current();
                    },
                    isEmpty: function () {
                        return 0 === this.count();
                    },
                    current: function () {
                        if (this.isEmpty()) {
                            return null;
                        }

                        return this.nodes[this.idx];
                    },
                    reset: function () {
                        this.nodes = [];
                        this.idx = 0;
                    },
                    count: function () {
                        return this.nodes.length;
                    },
                };

                function showCurrent(state) {
                    let currentNode = state.current(),
                        currentRect,
                        searchRect;

                    if (currentNode) {
                        reveal(currentNode);
                        highlight(root, currentNode, state.nodes);

                        if ("scrollIntoView" in currentNode) {
                            currentNode.scrollIntoView(true);
                            currentRect = currentNode.getBoundingClientRect();
                            searchRect = search.getBoundingClientRect();

                            if (
                                currentRect.top <
                                searchRect.top + searchRect.height
                            ) {
                                window.scrollBy(
                                    0,
                                    -(searchRect.top + searchRect.height + 5)
                                );
                            }
                        }
                    }

                    counter.textContent =
                        (state.isEmpty() ? 0 : state.idx + 1) +
                        " of " +
                        state.count();
                }

                let search = doc.createElement("div");

                search.className =
                    "exen-dump-search-wrapper exen-dump-search-hidden";

                search.innerHTML =
                    '<input type="text" class="exen-dump-search-input">' +
                    '<span class="exen-dump-search-count">0 of 0</span>' +
                    '<button type="button" class="exen-dump-search-input-previous" tabindex="-1">' +
                    '<svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 1331l-166 165q-19 19-45 19t-45-19L896 965l-531 531q-19 19-45 19t-45-19l-166-165q-19-19-19-45.5t19-45.5l742-741q19-19 45-19t45 19l742 741q19 19 19 45.5t-19 45.5z"/></svg>' +
                    "</button>" +
                    '<button type="button" class="exen-dump-search-input-next" tabindex="-1">' +
                    '<svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 808l-742 741q-19 19-45 19t-45-19L109 808q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"/></svg>' +
                    "</button>";

                root.insertBefore(search, root.firstChild);

                let state = new SearchState();
                let searchInput = search.querySelector(
                    ".exen-dump-search-input"
                );
                let counter = search.querySelector(".exen-dump-search-count");
                let searchInputTimer = 0;
                let previousSearchQuery = "";

                addEventListener(searchInput, "keyup", function (event) {
                    let searchQuery = event.target.value;

                    /* Don't perform anything if the pressed key didn't change the query */
                    if (searchQuery === previousSearchQuery) {
                        return;
                    }

                    previousSearchQuery = searchQuery;

                    clearTimeout(searchInputTimer);

                    searchInputTimer = setTimeout(function () {
                        state.reset();
                        collapseAll(root);
                        resetHighlightedNodes(root);

                        if ("" === searchQuery) {
                            counter.textContent = "0 of 0";

                            return;
                        }

                        let classMatches = [
                            "exen-dump-str",
                            "exen-dump-key",
                            "exen-dump-public",
                            "exen-dump-protected",
                            "exen-dump-private",
                        ]
                            .map(xpathHasClass)
                            .join(" or ");

                        let xpathResult = doc.evaluate(
                            ".//span[" +
                            classMatches +
                            "][contains(translate(child::text(), " +
                            xpathString(searchQuery.toUpperCase()) +
                            ", " +
                            xpathString(searchQuery.toLowerCase()) +
                            "), " +
                            xpathString(searchQuery.toLowerCase()) +
                            ")]",
                            root,
                            null,
                            XPathResult.ORDERED_NODE_ITERATOR_TYPE,
                            null
                        );

                        let node = null;

                        while ((node = xpathResult.iterateNext()))
                            state.nodes.push(node);

                        showCurrent(state);
                    }, 400);
                });

                Array.from(
                    search.querySelectorAll(
                        ".exen-dump-search-input-next, .exen-dump-search-input-previous"
                    )
                ).forEach(function (btn) {
                    addEventListener(btn, "click", function (event) {
                        event.preventDefault() - 1 !==
                        event.target.className.indexOf("next")
                            ? state.next()
                            : state.previous();
                        searchInput.focus();
                        collapseAll(root);
                        showCurrent(state);
                    });
                });

                addEventListener(root, "keydown", function (event) {
                    let isSearchActive = !/\bexen-dump-search-hidden\b/.test(
                        search.className
                    );

                    if (
                        (114 === event.keyCode && !isSearchActive) ||
                        (isCtrlKey(event) && 70 === event.keyCode)
                    ) {
                        /* F3 or CMD/CTRL + F */
                        if (
                            70 === event.keyCode &&
                            document.activeElement === searchInput
                        ) {
                            /*
                             * If CMD/CTRL + F is hit while having focus on search input,
                             * the user probably meant to trigger browser search instead.
                             * Let the browser execute its behavior:
                             */
                            return;
                        }

                        event.preventDefault();
                        search.className = search.className.replace(
                            /\bexen-dump-search-hidden\b/,
                            ""
                        );
                        searchInput.focus();
                    } else if (isSearchActive) {
                        if (27 === event.keyCode) {
                            /* ESC key */
                            search.className += " exen-dump-search-hidden";
                            event.preventDefault();
                            resetHighlightedNodes(root);
                            searchInput.value = "";
                        } else if (
                            (isCtrlKey(event) &&
                                71 === event.keyCode) /* CMD/CTRL + G */ ||
                            13 === event.keyCode /* Enter */ ||
                            114 === event.keyCode /* F3 */
                        ) {
                            event.preventDefault();
                            event.shiftKey ? state.previous() : state.next();
                            collapseAll(root);
                            showCurrent(state);
                        }
                    }
                });
            }

            if (0 >= options.maxStringLength) return;

            try {
                elt = root.querySelectorAll(".exen-dump-str");
                len = elt.length;
                it = 0;
                t = [];

                while (it < len) t.push(elt[it++]);

                len = t.length;

                for (it = 0; it < len; ++it) {
                    elt = t[it];
                    s = elt.innerText || elt.textContent;
                    x = s.length - options.maxStringLength;

                    if (0 < x) {
                        h = elt.innerHTML;
                        elt[elt.innerText ? "innerText" : "textContent"] = s.substring(0, options.maxStringLength);
                        elt.className += " exen-dump-str-collapse";
                        elt.innerHTML =
                            "<span class=exen-dump-str-collapse>" +
                            h +
                            '<a class="exen-dump-ref exen-dump-str-toggle" title="Collapse"> ◀</a></span>' +
                            "<span class=exen-dump-str-expand>" +
                            elt.innerHTML +
                            '<a class="exen-dump-ref exen-dump-str-toggle" title="' +
                            x +
                            ' remaining characters"> ▶</a></span>';
                    }
                }
            } catch (ex) {
                console.debug(ex);
            }
        };
    })(document);
HTML;

        $html = str_replace('{$options}', json_encode($displayOptions, JSON_FORCE_OBJECT), $html);

        $html = preg_replace('/\s+/', ' ', $html) . '</script>' . PHP_EOL;

        echo $html;

        echo '<div id="exen-debug">' . PHP_EOL;
        echo '    <fieldset id="one">' . PHP_EOL;
        echo '        <legend id="one">' . PHP_EOL;
        echo '            <span class="exen-no-select">FILE</span>' . '<span id="colon"></span>' . '<span>' . $callee['file'] . '</span>' . '<span></span>' . '<span class="exen-no-select">LINE</span>' . '<span id="colon"></span>' . '<span>' . $callee['line'] . '</span>' . PHP_EOL;
        echo '        </legend>' . PHP_EOL;
        echo '        <pre id="one" class="exen-dump">' . PHP_EOL;
        echo '            <code id="one">' . PHP_EOL;

        foreach ($params as $param) {
            echo '<div id="head">' . '<strong><span class="exen-no-select">Debug</span><span class="exen-no-select"> #</span>' . '<span>' . ++$it . '</span>' . '<span class="exen-no-select"> of </span>' . '<span>' . $argc . '</span>' . '</strong>' . '<span id="colon"></span>' . '</div>' . PHP_EOL . PHP_EOL;
            // echo '<br/>' . PHP_EOL;
            echo '<span id="code-content">' . PHP_EOL;
            @var_dump($param);
            echo '</span>' . PHP_EOL;
        }

        echo '            </code>' . PHP_EOL;
        echo '        </pre>' . PHP_EOL;
        echo '    </fieldset>' . PHP_EOL;
        echo '<div>' . PHP_EOL;
        echo '<br class="exen-no-select">' . PHP_EOL;

        die(0);
    }
}
