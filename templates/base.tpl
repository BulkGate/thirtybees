<div id="thirty-bees-sms">
    <nav>
        <div class="container-fluid">
            <div class="nav-wrapper">
                <div id="brand-logo">
                    <a class="brand-logo hide-on-med-and-down" href="{$homepage|bulkGateEscapeUrl}">
                    <img alt="bulkgate" width="120" src="{$logo|bulkGateEscapeUrl}" />
                    </a>
                </div>
                <ul class="controls">
                    <span id="react-app-panel-admin-buttons"></span>
                    <span id="react-app-info"></span>
                </ul>
                <div class="nav-h1">
                    <span class="h1-divider"></span>
                    <h1 class="truncate">{$title|bulkGateEscapeHtml}<span id="react-app-h1-sub"></span></h1>
                </div>
            </div>
        </div>
    </nav>
    <div id="profile-tab"></div>
    <div{if isset($box) && $box} class="module-box"{/if}>
    <div id="react-snack-root"></div>
    <div id="react-app-root">
        <div class="loader loading">
            <div class="spinner"></div>
            <p>{'Loading content'|bulkGateTranslate}</p>
        </div>
    </div>
    <div id="react-language-footer"></div>
    <script type="application/javascript">

        var _bg_client_config = {
            url: {
                authenticationService : 'ajax-tab.php',
            },
            actions: {
                authenticate: function () {
                    return {
                        data: {$authenticate|bulkGateEscapeJs}
                    }
                }
            }
        };
    </script>
    <script src="{$widget_api_url|bulkGateEscapeUrl}"></script>
    <script type="application/javascript">
        _bg_client.registerMiddleware(function (data)
        {
            if(data.init._generic)
            {
                data.init.env.homepage.logo_link = {$logo|bulkGateEscapeJs};
                data.init._generic.scope.module_info = {$info|bulkGateEscapeJs}
            }
        });

        var input = _bg_client.parseQuery(location.search);

        _bg_client.require({$application_id|bulkGateEscapeJs}, {
            product: "tb",
            language: {$language|bulkGateEscapeJs},
            salt: {$salt|bulkGateEscapeJs},
            view: {
                presenter: {$presenter|bulkGateEscapeJs},
                action: {$action|bulkGateEscapeJs},
            },
            params: {
                id: {if isset($id) && $id}{$id|bulkGateEscapeJs}{else}input["id"]{/if},
                key: {if isset($key) && $key}{$key|bulkGateEscapeJs}{else}input["key"]{/if},
                type: {if isset($type) && $type}{$type|bulkGateEscapeJs}{else}input["type"]{/if},
            },
            proxy: {$proxy|bulkGateEscapeJs},
        });
    </script>
    </div>
</div>