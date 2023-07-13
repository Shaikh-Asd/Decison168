function Tour(steps, currentTab, options) {    
    this.options = options || {};
    this.currentTab = parseInt(currentTab) || 0;
    this.steps = steps;

    //HTML elements container
    this.elements = {};

    //Helper which works similar to $.extend
    this.extend = function(a, b) {
        for (var key in b)
            if (b.hasOwnProperty(key))
                a[key] = b[key];
        return a;
    }

    var defaultTranslations = {
        next: "Next",
        previous: "Previous",
        finish: "Finish"
    };

    var getPopoverSettings = function(arrows) {
        var template = '<div id="tour" class="popover popover-tour" role="tooltip">' +
            '<div class="popover-arrow"></div>';
        if (!arrows) {
            template = '<div id="tour" class="popover popover-tour popover-tour-center" role="tooltip">';
        }

        template += '<div class="tour-exit"></div>' +
            '<h3 class="popover-header"></h3>' +
            '<div class="popover-body">' +
            '</div>' +
            '<div class="popover-footer">' +
            '   <a class="btn tour-initial">Restart</a>' +
            '   <a class="btn tour-skip" id="tour-skip">Skip</a>' +
            '   <a class="btn tour-next">' +
            translations.next +
            '   </a>' +
            '   <a class="btn btn-dark-green tour-finish hidden" id="tour-finish">' +
            translations.finish +
            '   </a>' +
            '   <a class="btn tour-prev">' +
            translations.previous +
            '   </a>' +
            '</div>' +
            '</div>';

        return {
            placement: "auto",
            template: template,
            trigger: "manual",
            html: true,
            sanitize: false
        };
    }

    var translations = this.extend(defaultTranslations, this.options.translations);
    this.defaultOptions = {
        popoverNoArrows: getPopoverSettings(false),
        popover: getPopoverSettings(true)
    }
}

Tour.prototype.getCurrentStepContent = function() {
    return this.steps[this.currentTab].content;
}

Tour.prototype.getCurrentStepTitle = function() {
    return this.steps[this.currentTab].title || "";
}

Tour.prototype.createTabLinks = function() {
    var html = '<ul class="tour-tab-links">';
    for (var i = 0; i < this.steps.length; i++) {
        var cssClass = i === parseInt(this.currentTab) ? "active" : "";
        html += '<li><a role="button" class="' + cssClass + '" data-tour-step="' + i + '">&nbsp;</a></li>';
    }

    html += '</ul>';
    return html;
}

Tour.prototype.createContent = function() {
    var content = this.getCurrentStepContent();
    content += this.createTabLinks();
    return content;
}

Tour.prototype.addBackdrop = function() {
    var backdrop = document.getElementsByClassName("modal-backdrop");

    if (backdrop.length === 0) {
        var body = document.getElementsByTagName("body")[0];
        var backdropElement = document.createElement('div');
        backdropElement.classList.add("modal-backdrop", "show");
        body.appendChild(backdropElement);

    }
}

Tour.prototype.removeBackdrop = function() {
    var backdrop = document.getElementsByClassName("modal-backdrop");

    if (backdrop.length > 0) {
        backdrop[0].remove();

    }
}

Tour.prototype.getContainerByIndex = function(index) {  
    var tourPopover = document.getElementsByTagName("body")[0];
    if (this.steps[index].id) {
        tourPopover = document.getElementById(this.steps[index].id);
    }
    return tourPopover;
}

Tour.prototype.getDefaultPopoverSettings = function() {
    var container = this.getContainerByIndex(this.currentTab);
    if (container.tagName.toLowerCase() === "body") {
        return this.defaultOptions.popoverNoArrows;
    } else {
        return this.defaultOptions.popover;
    }
}

Tour.prototype.show = function() {
    this.addBackdrop();

    var opt = {};
    opt = this.extend(this.getDefaultPopoverSettings(), this.options.popover || {});

    opt.title = this.getCurrentStepTitle();
    opt.content = this.createContent();

    var tourPopover = this.getContainerByIndex(this.currentTab);
    var popover = new bootstrap.Popover(tourPopover, opt);
    var initial_step = 0;

    popover.show();

    var o = this;
    var e = {
        btnNext: popover.tip.getElementsByClassName("tour-next")[0],
        btnPrev: popover.tip.getElementsByClassName("tour-prev")[0],
        btnInit: popover.tip.getElementsByClassName("tour-initial")[0],
        btnFinish: popover.tip.getElementsByClassName("tour-finish")[0],
        btnExit: popover.tip.getElementsByClassName("tour-exit")[0],
        btnSkip: popover.tip.getElementsByClassName("tour-skip")[0]
    };

        if(opt.title == 'Start My Tour'){
            var tour_step = 0;
        }
        if(opt.title == 'The Dashboard'){
            var tour_step = 1;
        }
        if(opt.title == 'Motivator'){
            var tour_step = 2;
        }
        if(opt.title == 'My Day'){
            var tour_step = 3;
        }
        if(opt.title == 'My Next 168'){
            var tour_step = 4;
        }
        if(opt.title == 'My Alerts'){
            var tour_step = 5;
        }
        if(opt.title == 'Portfolio Drop Down'){
            var tour_step = 6;
        }
        if(opt.title == 'Upgrade Button'){
            var tour_step = 7;
        }
        if(opt.title == 'Profile'){
            var tour_step = 8;
        }
        if(opt.title == 'Calendar'){
            var tour_step = 9;
        }
        if(opt.title == 'Portfolio Drop Down'){
            var tour_step = 10;
        }
        if(opt.title == 'Portfolio'){
            var tour_step = 10;
        }
        if(opt.title == 'Goals & Strategies'){
            var tour_step = 11;
        }
        if(opt.title == 'Projects'){
            var tour_step = 12;
        }
        if(opt.title == 'Tasks'){
            var tour_step = 13;
        }
        if(opt.title == 'Content Planner'){
            var tour_step = 14;
        }
        if(opt.title == 'File Cabinet'){
            var tour_step = 15;
        }
        if(opt.title == 'Archive'){
            var tour_step = 16;
        }
        if(opt.title == 'Trash'){
            var tour_step = 17;
        }
        if(opt.title == 'Support'){
            var tour_step = 18;
        }
        console.log(opt.title);
        $.ajax({
            url:base_url+'front/insert_tour_step',
            type:"POST",
            data:{
                tour_step:tour_step
            },
            success: function(data){
                console.log(data);
            }// success msg ends here
        });

    //Init events
    e.btnNext.addEventListener("click", function() {
        o.refreshTab(parseInt(o.currentTab) + 1);
    });
    e.btnPrev.addEventListener("click", function() {
        o.refreshTab(parseInt(o.currentTab) - 1);
    });
    e.btnInit.addEventListener("click", function() {
        o.refreshTab(initial_step);
    });

    var onExit = function() {
        o.removeBackdrop();
        o.removeActiveElement();
        o.popover.dispose();
    }
    e.btnFinish.addEventListener("click", function() {
        onExit();
    });

    e.btnExit.addEventListener("click", function() {
        onExit();
    });

    var steps1 = [{
        title: "Navigation Bar: My Tour",
        id: "tour_logout_menu",
        content: "<p class='popover-content'>From dropdown you can start your tour again by clicking on My Tour</p>"
    }];
    var last_tour = new Tour(steps1);
    e.btnSkip.addEventListener("click", function() {
        onExit();
        var tour_session = localStorage.getItem('tour_session');
        if(tour_session == 'skip_tour'){
            last_tour.show();
            localStorage.setItem('tour_session', 'no');
        }
    });

    var tabLinks = popover.tip.getElementsByClassName("tour-tab-links")[0].getElementsByTagName("a");
    for (var i = 0; i < tabLinks.length; i++) {
        tabLinks[i].addEventListener("click",
            function() {
                var step = parseInt(this.dataset.tourStep);
                o.refreshTab(step);
            });
    }
    this.popover = popover;
    this.elements = e;

    this.updateButtonsVisibility();
    this.updateActiveElement();
}

//Moves current HTML element before backdrop (by changing z-index)
Tour.prototype.updateActiveElement = function() {

    for (var i = 0; i < this.steps.length; i++) {
        var e = this.getContainerByIndex(i);;
        if (i === this.currentTab) {
            e.classList.add("tour-active-element");
            if(i > 0){
                e.classList.add("tour-active-field");
            }
            e.scrollIntoView();
        } else {
            e.classList.remove("tour-active-element");
            if(i > 0){
                e.classList.remove("tour-active-field");
            }
        }

    }
}

Tour.prototype.removeActiveElement = function() {
    this.currentTab = -1;
    this.updateActiveElement();
    this.currentTab = 0
}

Tour.prototype.updateButtonsVisibility = function() {

    if (this.steps.length === 1) {
        this.elements.btnSkip.classList.add("hidden");
    } else {
        this.elements.btnSkip.classList.remove("hidden");
    }

    if (this.currentTab === 0) {
        this.elements.btnPrev.classList.add("hidden");
        this.elements.btnInit.classList.add("hidden");
    } else {
        this.elements.btnPrev.classList.remove("hidden");
        this.elements.btnInit.classList.remove("hidden");
    }

    if (this.currentTab === this.steps.length - 1) {
        this.elements.btnNext.classList.add("hidden");
        this.elements.btnFinish.classList.remove("hidden");
    } else {
        this.elements.btnNext.classList.remove("hidden");
        this.elements.btnFinish.classList.add("hidden");
    }
}

Tour.prototype.refreshTab = function(index) {
    this.popover.dispose();
    this.currentTab = index;
    this.show();



    var lis = this.popover.tip.getElementsByClassName("tour-tab-links")[0].getElementsByTagName("a");
    for (var i = 0; i < lis.length; i++) {
        if (i === index) {
            lis[i].classList.add("active");
        } else {
            lis[i].classList.remove("active");
        }

    }

    var tabs = this.popover.tip.getElementsByClassName("tour-tab");
    for (var j = 0; j < tabs.length; j++) {
        if (j === index) {
            tabs[j].classList.add("active");
        } else {
            tabs[j].classList.remove("active");
        }

    }
}