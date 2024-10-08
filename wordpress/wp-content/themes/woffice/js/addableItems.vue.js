/**
 * Addable Items Vue Application
 * Render addable items input through Vue.js
 *
 * @author Alkaweb Team
 */
Vue.component('woffice-addable-items', {

    template: '<div id="woffice-addable-items">\
        <div id="woffice-addable-items__title">\
            <h3 v-text="label"></h3>\
        </div>\
        <div v-for="(item, i) in items" class="addable-item">\
            <a href="#" class="addable-item__close text-light" @click.prevent="removeItem(i)"><i class="fas fa-times"></i></a>\
            <div class="row">\
                <div v-for="(field, key) in fields" :class="field.layout" class="addable-item__field">\
                    <div>\
                        <label>\
                            <span v-text="field.label"> <i v-if="field.help" class="fa fa-info-circle"></i></span>\
                        </label>\
                        <select v-if="field.type === \'icon-picker\'" v-model="item[field.key]">\
                            <option v-for="icon in icons">\
                                <i class="fa" :class="icon"></i> <span v-text="icon"></span>\
                            </option>\
                        </select>\
                        <input v-else type="text" v-model="item[field.key]">\
                    </div>\
                </div>\
            </div>\
        </div>\
        <div id="woffice-addable-items__actions">\
            <a href="#" @click.prevent="addItem()" class="btn btn-default"><i class="fa fa-plus-square"></i> Add</a>\
        </div>\
        <input type="hidden" :name="name" :value="itemsReady">\
    </div>',

    props: ['data', 'label', 'name'],

    /**
     * Data Wrapper
     */
    data: function () {
        return {
            items: [],
            icons: [],
            fields: [
                {
                    key: 'title',
                    label: 'Content',
                    layout: 'col-md-6'
                },
                {
                    key: 'icon',
                    label: 'Icon',
                    layout: 'col-md-6',
                    type: 'icon-picker'
                }
            ]
        }
    },

    computed: {
        itemsReady: function () {
            return JSON.stringify(this.items);
        }
    },

    mounted: function() {
        this.setIcons();
        if (this.data)
            this.items = this.data;
    },

    methods: {

        /**
         * Add a new item
         */
        addItem: function () {
            var newField = {};

            for (var fieldKey in this.fields) {
                if (!this.fields.hasOwnProperty(fieldKey))
                    continue;

                newField[this.fields[fieldKey].key] = '';
            }

            this.items.push(newField);
        },

        /**
         * Remove items
         */
        removeItem: function (key) {
            this.items.splice(key, 1);
        },

        /**
         * Set the icons library
         * https://gist.github.com/zwinnie/3ed8e7970240962bc29227533c3ae047
         *
         */
        setIcons: function () {
            this.icons = [
                "fa-500px",
                "fa-address-book",
                "fa-address-card",
                "fa-adjust",
                "fa-adn",
                "fa-align-center",
                "fa-align-justify",
                "fa-align-left",
                "fa-align-right",
                "fa-amazon",
                "fa-ambulance",
                "fa-american-sign-language-interpreting",
                "fa-anchor",
                "fa-android",
                "fa-angellist",
                "fa-angle-double-down",
                "fa-angle-double-left",
                "fa-angle-double-right",
                "fa-angle-double-up",
                "fa-angle-down",
                "fa-angle-left",
                "fa-angle-right",
                "fa-angle-up",
                "fa-apple",
                "fa-archive",
                "fa-area-chart",
                "fa-arrow-circle-down",
                "fa-arrow-circle-left",
                "fa-arrow-circle-o-down",
                "fa-arrow-circle-o-left",
                "fa-arrow-circle-o-right",
                "fa-arrow-circle-o-up",
                "fa-arrow-circle-right",
                "fa-arrow-circle-up",
                "fa-arrow-down",
                "fa-arrow-left",
                "fa-arrow-right",
                "fa-arrow-up",
                "fa-arrows",
                "fa-arrows-alt",
                "fa-arrows-h",
                "fa-arrows-v",
                "fa-asl-interpreting",
                "fa-assistive-listening-systems",
                "fa-asterisk",
                "fa-at",
                "fa-audio-description",
                "fa-automobile",
                "fa-backward",
                "fa-balance-scale",
                "fa-ban",
                "fa-bandcamp",
                "fa-bank",
                "fa-bar-chart",
                "fa-barcode",
                "fa-bars",
                "fa-bath",
                "fa-bathtub",
                "fa-battery",
                "fa-battery-0",
                "fa-battery-1",
                "fa-battery-2",
                "fa-battery-3",
                "fa-battery-4",
                "fa-battery-empty",
                "fa-battery-full",
                "fa-battery-half",
                "fa-battery-quarter",
                "fa-battery-three-quarters",
                "fa-bed",
                "fa-beer",
                "fa-bell",
                "fa-bell-slash",
                "fa-bicycle",
                "fa-binoculars",
                "fa-birthday-cake",
                "fa-bitbucket",
                "fa-bitbucket-square",
                "fa-bitcoin",
                "fa-black-tie",
                "fa-blind",
                "fa-bluetooth",
                "fa-bluetooth-b",
                "fa-bold",
                "fa-bolt",
                "fa-bomb",
                "fa-book",
                "fa-bookmark",
                "fa-braille",
                "fa-briefcase",
                "fa-btc",
                "fa-bug",
                "fa-building",
                "fa-bullhorn",
                "fa-bullseye",
                "fa-bus",
                "fa-buysellads",
                "fa-cab",
                "fa-calculator",
                "fa-calendar",
                "fa-camera",
                "fa-camera-retro",
                "fa-car",
                "fa-caret-down",
                "fa-caret-left",
                "fa-caret-right",
                "fa-caret-up",
                "fa-cart-arrow-down",
                "fa-cart-plus",
                "fa-cc",
                "fa-cc-amex",
                "fa-cc-diners-club",
                "fa-cc-discover",
                "fa-cc-jcb",
                "fa-cc-mastercard",
                "fa-cc-paypal",
                "fa-cc-stripe",
                "fa-cc-visa",
                "fa-certificate",
                "fa-chain",
                "fa-chain-broken",
                "fa-check",
                "fa-check-circle",
                "fa-check-circle",
                "fa-check-square",
                "fa-chevron-circle-down",
                "fa-chevron-circle-left",
                "fa-chevron-circle-right",
                "fa-chevron-circle-up",
                "fa-chevron-down",
                "fa-chevron-left",
                "fa-chevron-right",
                "fa-chevron-up",
                "fa-child",
                "fa-chrome",
                "fa-circle",
                "fa-circle-thin",
                "fa-clipboard",
                "fa-clone",
                "fa-close",
                "fa-cloud",
                "fa-cloud-download",
                "fa-cloud-upload",
                "fa-cny",
                "fa-code",
                "fa-code-fork",
                "fa-codepen",
                "fa-codiepie",
                "fa-coffee",
                "fa-cog",
                "fa-cogs",
                "fa-columns",
                "fa-comment",
                "fa-commenting",
                "fa-comments",
                "fa-compass",
                "fa-compress",
                "fa-connectdevelop",
                "fa-contao",
                "fa-copy",
                "fa-copyright",
                "fa-creative-commons",
                "fa-credit-card",
                "fa-credit-card-alt",
                "fa-crop",
                "fa-crosshairs",
                "fa-css3",
                "fa-cube",
                "fa-cubes",
                "fa-cut",
                "fa-cutlery",
                "fa-dashboard",
                "fa-dashcube",
                "fa-database",
                "fa-deaf",
                "fa-deafness",
                "fa-dedent",
                "fa-delicious",
                "fa-desktop",
                "fa-deviantart",
                "fa-diamond",
                "fa-digg",
                "fa-dollar",
                "fa-download",
                "fa-dribbble",
                "fa-drivers-license",
                "fa-dropbox",
                "fa-drupal",
                "fa-edge",
                "fa-edit",
                "fa-eercast",
                "fa-eject",
                "fa-ellipsis-h",
                "fa-ellipsis-v",
                "fa-empire",
                "fa-envelope",
                "fa-envelope-open",
                "fa-envelope-square",
                "fa-envira",
                "fa-eraser",
                "fa-etsy",
                "fa-eur",
                "fa-euro",
                "fa-exchange",
                "fa-exclamation",
                "fa-exclamation-circle",
                "fa-exclamation-triangle",
                "fa-expand",
                "fa-expeditedssl",
                "fa-external-link",
                "fa-external-link-square",
                "fa-eye",
                "fa-eye-slash",
                "fa-eyedropper",
                "fa-fa",
                "fa-facebook",
                "fa-facebook-f",
                "fa-facebook-official",
                "fa-facebook-square",
                "fa-fast-backward",
                "fa-fast-forward",
                "fa-fax",
                "fa-feed",
                "fa-female",
                "fa-fighter-jet",
                "fa-file",
                "fa-file-text",
                "fa-film",
                "fa-filter",
                "fa-fire",
                "fa-fire-extinguisher",
                "fa-firefox",
                "fa-first-order",
                "fa-flag",
                "fa-flag-checkered",
                "fa-flash",
                "fa-flask",
                "fa-flickr",
                "fa-folder",
                "fa-folder-open",
                "fa-font",
                "fa-font-awesome",
                "fa-fonticons",
                "fa-fort-awesome",
                "fa-forumbee",
                "fa-forward",
                "fa-foursquare",
                "fa-free-code-camp",
                "fa-gamepad",
                "fa-gavel",
                "fa-gbp",
                "fa-ge",
                "fa-gear",
                "fa-gears",
                "fa-genderless",
                "fa-get-pocket",
                "fa-gg",
                "fa-gg-circle",
                "fa-gift",
                "fa-git",
                "fa-git-square",
                "fa-github",
                "fa-github-alt",
                "fa-github-square",
                "fa-gitlab",
                "fa-gittip",
                "fa-glass",
                "fa-glide",
                "fa-glide-g",
                "fa-globe",
                "fa-google",
                "fa-google-plus",
                "fa-google-plus-circle",
                "fa-google-plus-official",
                "fa-google-plus-square",
                "fa-google-wallet",
                "fa-graduation-cap",
                "fa-gratipay",
                "fa-grav",
                "fa-group",
                "fa-h-square",
                "fa-hacker-news",
                "fa-hard-of-hearing",
                "fa-hashtag",
                "fa-header",
                "fa-headphones",
                "fa-heart",
                "fa-heartbeat",
                "fa-history",
                "fa-home",
                "fa-hotel",
                "fa-hourglass",
                "fa-hourglass-1",
                "fa-hourglass-2",
                "fa-hourglass-3",
                "fa-hourglass-end",
                "fa-hourglass-half",
                "fa-hourglass-start",
                "fa-houzz",
                "fa-html5",
                "fa-i-cursor",
                "fa-id-badge",
                "fa-id-card",
                "fa-ils",
                "fa-image",
                "fa-imdb",
                "fa-inbox",
                "fa-indent",
                "fa-industry",
                "fa-info",
                "fa-info-circle",
                "fa-inr",
                "fa-instagram",
                "fa-institution",
                "fa-internet-explorer",
                "fa-intersex",
                "fa-ioxhost",
                "fa-italic",
                "fa-joomla",
                "fa-jpy",
                "fa-jsfiddle",
                "fa-key",
                "fa-krw",
                "fa-language",
                "fa-laptop",
                "fa-lastfm",
                "fa-lastfm-square",
                "fa-leaf",
                "fa-leanpub",
                "fa-legal",
                "fa-level-down",
                "fa-level-up",
                "fa-life-bouy",
                "fa-life-buoy",
                "fa-life-ring",
                "fa-life-saver",
                "fa-line-chart",
                "fa-link",
                "fa-linkedin",
                "fa-linkedin-square",
                "fa-linode",
                "fa-linux",
                "fa-list",
                "fa-list-alt",
                "fa-list-ol",
                "fa-list-ul",
                "fa-location-arrow",
                "fa-lock",
                "fa-long-arrow-down",
                "fa-arrow-left",
                "fa-arrow-right",
                "fa-long-arrow-up",
                "fa-low-vision",
                "fa-magic",
                "fa-magnet",
                "fa-mail-forward",
                "fa-mail-reply",
                "fa-mail-reply-all",
                "fa-male",
                "fa-map",
                "fa-map-marker",
                "fa-map-pin",
                "fa-map-signs",
                "fa-mars",
                "fa-mars-double",
                "fa-mars-stroke",
                "fa-mars-stroke-h",
                "fa-mars-stroke-v",
                "fa-maxcdn",
                "fa-meanpath",
                "fa-medium",
                "fa-medkit",
                "fa-meetup",
                "fa-mercury",
                "fa-microchip",
                "fa-microphone",
                "fa-microphone-slash",
                "fa-minus",
                "fa-minus-circle",
                "fa-minus-square",
                "fa-mixcloud",
                "fa-mobile",
                "fa-mobile-phone",
                "fa-modx",
                "fa-money",
                "fa-mortar-board",
                "fa-motorcycle",
                "fa-mouse-pointer",
                "fa-music",
                "fa-navicon",
                "fa-neuter",
                "fa-object-group",
                "fa-object-ungroup",
                "fa-odnoklassniki",
                "fa-odnoklassniki-square",
                "fa-opencart",
                "fa-openid",
                "fa-opera",
                "fa-optin-monster",
                "fa-outdent",
                "fa-pagelines",
                "fa-paint-brush",
                "fa-paper-plane",
                "fa-paperclip",
                "fa-paragraph",
                "fa-paste",
                "fa-pause",
                "fa-pause-circle",
                "fa-paw",
                "fa-paypal",
                "fa-pencil",
                "fa-pencil-square",
                "fa-percent",
                "fa-phone",
                "fa-phone-square",
                "fa-photo",
                "fa-pie-chart",
                "fa-pied-piper",
                "fa-pied-piper-alt",
                "fa-pied-piper-pp",
                "fa-pinterest",
                "fa-pinterest-p",
                "fa-pinterest-square",
                "fa-plane",
                "fa-play",
                "fa-play-circle",
                "fa-plug",
                "fa-plus",
                "fa-plus-circle",
                "fa-plus-square",
                "fa-podcast",
                "fa-power-off",
                "fa-print",
                "fa-product-hunt",
                "fa-puzzle-piece",
                "fa-qq",
                "fa-qrcode",
                "fa-question",
                "fa-question-circle",
                "fa-quora",
                "fa-quote-left",
                "fa-quote-right",
                "fa-ra",
                "fa-random",
                "fa-ravelry",
                "fa-rebel",
                "fa-recycle",
                "fa-reddit",
                "fa-reddit-alien",
                "fa-reddit-square",
                "fa-refresh",
                "fa-registered",
                "fa-remove",
                "fa-renren",
                "fa-reorder",
                "fa-repeat",
                "fa-reply",
                "fa-reply-all",
                "fa-resistance",
                "fa-retweet",
                "fa-rmb",
                "fa-road",
                "fa-rocket",
                "fa-rotate-left",
                "fa-rotate-right",
                "fa-rouble",
                "fa-rss",
                "fa-rss-square",
                "fa-rub",
                "fa-ruble",
                "fa-rupee",
                "fa-s15",
                "fa-safari",
                "fa-save",
                "fa-scissors",
                "fa-scribd",
                "fa-search",
                "fa-search-minus",
                "fa-search-plus",
                "fa-sellsy",
                "fa-send",
                "fa-server",
                "fa-share",
                "fa-share-alt",
                "fa-share-alt-square",
                "fa-share-square",
                "fa-shekel",
                "fa-sheqel",
                "fa-shield",
                "fa-ship",
                "fa-shirtsinbulk",
                "fa-shopping-bag",
                "fa-shopping-basket",
                "fa-shopping-cart",
                "fa-shower",
                "fa-sign-in",
                "fa-sign-language",
                "fa-sign-out",
                "fa-signal",
                "fa-signing",
                "fa-simplybuilt",
                "fa-sitemap",
                "fa-skyatlas",
                "fa-skype",
                "fa-slack",
                "fa-sliders",
                "fa-slideshare",
                "fa-sort",
                "fa-sort-alpha-asc",
                "fa-sort-alpha-desc",
                "fa-sort-amount-asc",
                "fa-sort-amount-desc",
                "fa-sort-asc",
                "fa-sort-desc",
                "fa-sort-down",
                "fa-sort-numeric-asc",
                "fa-sort-numeric-desc",
                "fa-sort-up",
                "fa-soundcloud",
                "fa-space-shuttle",
                "fa-spinner",
                "fa-spoon",
                "fa-spotify",
                "fa-square",
                "fa-stack-exchange",
                "fa-stack-overflow",
                "fa-star",
                "fa-star-half",
                "fa-star-half-empty",
                "fa-star-half-full",
                "fa-steam",
                "fa-steam-square",
                "fa-step-backward",
                "fa-step-forward",
                "fa-stethoscope",
                "fa-sticky-note",
                "fa-stop",
                "fa-stop-circle",
                "fa-street-view",
                "fa-strikethrough",
                "fa-stumbleupon",
                "fa-stumbleupon-circle",
                "fa-subscript",
                "fa-subway",
                "fa-suitcase",
                "fa-superpowers",
                "fa-superscript",
                "fa-support",
                "fa-table",
                "fa-tablet",
                "fa-tachometer",
                "fa-tag",
                "fa-tags",
                "fa-tasks",
                "fa-taxi",
                "fa-telegram",
                "fa-television",
                "fa-tencent-weibo",
                "fa-terminal",
                "fa-text-height",
                "fa-text-width",
                "fa-th",
                "fa-th-large",
                "fa-th-list",
                "fa-themeisle",
                "fa-thermometer",
                "fa-thermometer-0",
                "fa-thermometer-1",
                "fa-thermometer-2",
                "fa-thermometer-3",
                "fa-thermometer-4",
                "fa-thermometer-empty",
                "fa-thermometer-full",
                "fa-thermometer-half",
                "fa-thermometer-quarter",
                "fa-thermometer-three-quarters",
                "fa-thumb-tack",
                "fa-thumbs-down",
                "fa-thumbs-o-down",
                "fa-thumbs-o-up",
                "fa-thumbs-up",
                "fa-ticket",
                "fa-times",
                "fa-times-circle",
                "fa-times-rectangle",
                "fa-tint",
                "fa-toggle-down",
                "fa-toggle-left",
                "fa-toggle-off",
                "fa-toggle-on",
                "fa-toggle-right",
                "fa-toggle-up",
                "fa-trademark",
                "fa-train",
                "fa-transgender",
                "fa-transgender-alt",
                "fa-trash",
                "fa-tree",
                "fa-trello",
                "fa-tripadvisor",
                "fa-trophy",
                "fa-truck",
                "fa-try",
                "fa-tty",
                "fa-tumblr",
                "fa-tumblr-square",
                "fa-turkish-lira",
                "fa-tv",
                "fa-twitch",
                "fa-twitter",
                "fa-twitter-square",
                "fa-umbrella",
                "fa-underline",
                "fa-undo",
                "fa-universal-access",
                "fa-university",
                "fa-unlink",
                "fa-unlock",
                "fa-unlock-alt",
                "fa-unsorted",
                "fa-upload",
                "fa-usb",
                "fa-usd",
                "fa-user",
                "fa-user-circle",
                "fa-user-md",
                "fa-user-plus",
                "fa-user-secret",
                "fa-user-times",
                "fa-users",
                "fa-vcard",
                "fa-venus",
                "fa-venus-double",
                "fa-venus-mars",
                "fa-viacoin",
                "fa-viadeo",
                "fa-viadeo-square",
                "fa-video-camera",
                "fa-vimeo",
                "fa-vimeo-square",
                "fa-vine",
                "fa-vk",
                "fa-volume-control-phone",
                "fa-volume-down",
                "fa-volume-off",
                "fa-volume-up",
                "fa-warning",
                "fa-wechat",
                "fa-weibo",
                "fa-weixin",
                "fa-whatsapp",
                "fa-wheelchair",
                "fa-wheelchair-alt",
                "fa-wifi",
                "fa-wikipedia-w",
                "fa-window-close",
                "fa-window-maximize",
                "fa-window-minimize",
                "fa-window-restore",
                "fa-windows",
                "fa-won",
                "fa-wordpress",
                "fa-wpbeginner",
                "fa-wpexplorer",
                "fa-wpforms",
                "fa-wrench",
                "fa-xing",
                "fa-xing-square",
                "fa-y-combinator",
                "fa-y-combinator-square",
                "fa-yahoo",
                "fa-yc",
                "fa-yc-square",
                "fa-yelp",
                "fa-yen",
                "fa-yoast",
                "fa-youtube",
                "fa-youtube-play",
                "fa-youtube-square"
            ]
        }

    }

});

var element =  document.getElementById('directory-edit');
if (typeof(element) !== 'undefined' && element !== null) {
    new Vue({
        el: '#directory-edit'
    });
}
