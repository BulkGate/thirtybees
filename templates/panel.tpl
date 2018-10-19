<div class="panel">
    <div class="panel-heading">
        <i class="icon-envelope-alt"></i> BulkGate
    </div>
    <div id="thirty-bees-sms " style="margin: 0">
        <div id="react-snack-root"></div>
        <div id="react-app-root">
            <p>{'Loading content'|bulkGateTranslate}</p>
        </div>
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