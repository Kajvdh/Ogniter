<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title') - Online Stats for Ogame by Kaj</title>
    <meta name="description" content="@yield('description'). Information about the Fantasy Browser Game Ogame.">
    <meta name="author" content="Donato C. Laynes Gonzales">
    <base href="{{ $baseUrl }}">
    <script>
        window.Ogniter = {
            BASE_URL: "{{ $baseUrl }}/",
            CDN_HOST: "{{ $cdnHost }}"
        };
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title')>"/>
    <meta property="og:url" content="{{ $baseUrl.$currentPath }}"/>
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="{{ $cdnHost }}img/home-ogniter.jpg"/>
    <meta property="og:site_name" content="Ogniter"/>
    <meta property="fb:app_id" content="453851131318585"/>

    <link rel="canonical" href="{{ $baseScheme }}://en.{{ $baseDomain.$request->path() }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link id="bs-css" href="{{ $cdnHost }}css/bootstrap-{{ $currentThemeId }}.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Shojumaru" />
    <link href="{{ $cdnHost }}css/combined20160701.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ $cdnHost }}img/favicon.ico">
    @yield('head')
    @if ($environment=='production')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-71888810-4"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-71888810-4');
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{ $cdnHost }}js/jquery-1.7.2.min.js"><\/script>')</script>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Kreela_1 -->
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-4097649742400196"
            data-ad-slot="9803953975"
            data-ad-format="auto"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    @else
        <script src="{{ $cdnHost }}js/jquery-1.7.2.min.js"></script>
    @endif
</head>
<body>

<div id="fb-root"></div>
<div class="container">
    <div class="navbar">
        <div class="navbar-inner">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="pull-left">
                <a href="{{ $baseUrl }}"><img src="{{ $cdnHost }}img/ogniter-logo.png" alt="Ogniter" title="Ogniter" /></a> &nbsp;
            </div>
            <?php $path = $request->path(); $segment = $request->segment(0) ?>
            @if( ($segment == 'site'
                || $segment == 'terms-of-use'
                || $segment == 'privacy-policy'
                || strpos($path, 'evolution')!==FALSE
                || strpos($path, 'polls')!==FALSE
                || strpos($path, 'poll')!==FALSE) || $segment != 'site' )
                <div class="btn-group pull-left" >
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="hidden-phone"> {!! !empty($currentCountry)
                        ? '<i class="flag flag-'.e($currentCountry->flag).'"></i> '.e($currentCountry->domain)
                        : $lang->trans('ogniter.og_pick_a_domain') !!}</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" id="domains">
                        @foreach($countries as $dom)
                            <li><a href="{{ $dom->language }}">
                                    <i class="flag flag-{{ $dom->flag }}"></i> {{ $dom->domain }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @if(isset($currentCountry) && isset($universes)&& count($universes) )
                    <div class="btn-group pull-left" >
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="hidden-phone"> {{ isset($currentUniverse) ?
                          $currentUniverse->local_name : $lang->trans('ogniter.og_choose_a_server') }} </span><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" id="servers">
                            @foreach($universes as $universe)
                                <li><a href="{{ $currentCountry->language.'/'.$universe->id.'/galaxy' }}"><span{!! $universe->api_enabled ? '' : ' class="text-warning"' !!}>{{ $universe->local_name }}</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif

            <div class="btn-group pull-right" >
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-flag"></i> <span class="hidden-phone"> {{ $languages[$currentLanguageId]['desc'] }} </span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    @foreach( $languages as $key => $value )
                        <li><a href="{{ $baseScheme.'://'.$key.'.'.$baseDomain.$currentPath }}">
                                <i class="icon-blank
                            @if ($currentLanguageId==$key) icon-ok
                            @endif"></i> {{ $value['desc'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="btn-group pull-right" >
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-wrench"></i><span class="hidden-phone"></span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="site/flight_times"><i class="icon-time"></i> {{ $lang->trans('ogniter.flight_time_calculator')}} </a></li>
                    <?php /*<li><a href="site/battle"><i class="icon-time"></i> Battle simulator</a></li>*/ ?>
                </ul>
            </div>
            <div class="btn-group pull-right theme-container" >
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-tint"></i><span class="hidden-phone">
                        {{ $lang->trans('ogniter.theme').': '.$themes[$currentThemeId]['desc'] }}
                    </span><span class="caret"></span>
                </a>
                <ul class="dropdown-menu" id="themes">
                    @foreach($themes as $k => $th)
                        <li><a href="site/theme/{{ $k.'/'.\App\Ogniter\Tools\Strings\Encrypt::urlBase64Encode($currentPath) }}" rel="nofollow">
                                <i class="icon-blank
                            @if($currentThemeId==$th['name']) icon-ok
                            @endif"></i> {{ $th['desc'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="btn-group pull-right" >
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-gift"></i> <span class="hidden-phone"> Games </span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="games/bon-voyage">
                                <i class="icon-blank icon-plane"></i> Bon Voyage</a></li>
                </ul>
            </div>

            <div class="clearfix"></div>
            <div class="pull-left">
                <?php /*
					<ul class="nav">
						<li><a href="discussions"><i class="icon-pencil"></i> {{ $lang->trans('discussions') }}?></a>
					</ul> */ ?>
            </div>
            <div class="pull-right">
                &nbsp;
                @if($environment=='production')
                    <script id="_waut83">var _wau = _wau || []; _wau.push(["small", "6uc7x1fficvk", "t83"]);
                        (function() {var s=document.createElement("script"); s.async=true;
                            s.src="//widgets.amung.us/small.js";
                            document.getElementsByTagName("head")[0].appendChild(s);
                        })();</script>
                @endif
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="container">
    <noscript>
        <div class="row">
            <div class="alert alert-block span12">
                <p>{{ $lang->trans('ogniter.pls_enable_javascript') }}</p>
            </div>
        </div>
    </noscript>
    <div class="row">
        <div class="span2 main-menu-span">
            <div class="well nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li><a href="site/donators"><i class="icon-exclamation-sign"></i> Donators</a></li>
                    <li><a href="site/faq"><i class="icon-exclamation-sign"></i> {{ $lang->trans('ogniter.faq_support') }}</a></li>
                    <li><a href="site/recommended"><i class="icon-share"></i> {{ $lang->trans('ogniter.community_tools') }}</a></li>
                    <li><a href="site/evolution"><i class="icon-align-right"></i> {{ $lang->trans('ogniter.historical_statistics') }}</a></li>
                </ul>
            </div>
            @if ( !$agent->isMobile() )
                @include('classic.partials.ads.sidebar-ad')
            @endif
            <div class="box above-me clearfix visible-desktop">
                @include('classic.partials.social-buttons')
            </div>
        </div>

        <div id="content" class="span10">
            @include('classic.partials.ads.top-ad')
            <div class="row-fluid">
                <div class="span8">
                    @yield('breadcrumb')
                </div>
                <div class="span4">
                    @include('classic.partials.ads.mini-ad')
                </div>
            </div>
            <div class="row-fluid">
                @yield('content')
            </div>
            <div style="margin-top: 10px">
                @include('classic.partials.ads.bottom-ad')
            </div>
        </div>
    </div>
    <hr>
    <footer>
        <p class="pull-left">
            <a href="http://buscandoquehacer.com" target="_blank"> &copy; Donato Laynes</a> 2012-2016, revived by Kaj Van der Hallen | <a href="humans">Collaborators</a></p>
        <p class="pull-right">
            <a href="http://www.gameforge.com" target="_blank">{{ $lang->trans('ogniter.og_game_created_by') }}</a>.</p>
    </footer>
</div>
<script src="{{ $cdnHost }}js/combined2016.js"></script>
<script src="{{ $cdnHost }}js/mvc/routes/main.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('scripts')
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_EN/all.js#xfbml=1&appId=453851131318585";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>


<!-- blockadblock -->
<script type="text/javascript"  charset="utf-8">
// Place this code snippet near the footer of your page before the close of the /body tag
// LEGAL NOTICE: The content of this website and all associated program code are protected under the Digital Millennium Copyright Act. Intentionally circumventing this code may constitute a violation of the DMCA.
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}(';k O=\'\',29=\'1X\';1D(k i=0;i<12;i++)O+=29.X(C.K(C.I()*29.G));k 2E=8,2e=3a,2u=4x,3d=22,2y=D(e){k o=!1,i=D(){z(q.1j){q.35(\'2X\',t);F.35(\'1S\',t)}R{q.33(\'2V\',t);F.33(\'24\',t)}},t=D(){z(!o&&(q.1j||4y.2g===\'1S\'||q.32===\'2Y\')){o=!0;i();e()}};z(q.32===\'2Y\'){e()}R z(q.1j){q.1j(\'2X\',t);F.1j(\'1S\',t)}R{q.38(\'2V\',t);F.38(\'24\',t);k n=!1;2S{n=F.4A==4B&&q.1U}2P(r){};z(n&&n.2R){(D a(){z(o)H;2S{n.2R(\'16\')}2P(t){H 4C(a,50)};o=!0;i();e()})()}}};F[\'\'+O+\'\']=(D(){k e={e$:\'1X+/=\',4D:D(t){k a=\'\',d,n,o,c,s,l,i,r=0;t=e.t$(t);1c(r<t.G){d=t.17(r++);n=t.17(r++);o=t.17(r++);c=d>>2;s=(d&3)<<4|n>>4;l=(n&15)<<2|o>>6;i=o&63;z(37(n)){l=i=64}R z(37(o)){i=64};a=a+10.e$.X(c)+10.e$.X(s)+10.e$.X(l)+10.e$.X(i)};H a},11:D(t){k n=\'\',d,l,c,s,r,i,a,o=0;t=t.1m(/[^A-4w-4E-9\\+\\/\\=]/g,\'\');1c(o<t.G){s=10.e$.1M(t.X(o++));r=10.e$.1M(t.X(o++));i=10.e$.1M(t.X(o++));a=10.e$.1M(t.X(o++));d=s<<2|r>>4;l=(r&15)<<4|i>>2;c=(i&3)<<6|a;n=n+S.T(d);z(i!=64){n=n+S.T(l)};z(a!=64){n=n+S.T(c)}};n=e.n$(n);H n},t$:D(e){e=e.1m(/;/g,\';\');k n=\'\';1D(k o=0;o<e.G;o++){k t=e.17(o);z(t<1z){n+=S.T(t)}R z(t>3a&&t<4G){n+=S.T(t>>6|4H);n+=S.T(t&63|1z)}R{n+=S.T(t>>12|3g);n+=S.T(t>>6&63|1z);n+=S.T(t&63|1z)}};H n},n$:D(e){k o=\'\',t=0,n=4I=1C=0;1c(t<e.G){n=e.17(t);z(n<1z){o+=S.T(n);t++}R z(n>4J&&n<3g){1C=e.17(t+1);o+=S.T((n&31)<<6|1C&63);t+=2}R{1C=e.17(t+1);2K=e.17(t+2);o+=S.T((n&15)<<12|(1C&63)<<6|2K&63);t+=3}};H o}};k a=[\'4K==\',\'4L\',\'4M=\',\'4N\',\'4F\',\'4u=\',\'4l=\',\'4t=\',\'4d\',\'4e\',\'4f=\',\'4g=\',\'4h\',\'4i\',\'4j=\',\'4c\',\'4k=\',\'4m=\',\'4n=\',\'4o=\',\'4p=\',\'4q=\',\'4r==\',\'4s==\',\'4O==\',\'4v==\',\'4P=\',\'5c\',\'5e\',\'5f\',\'5g\',\'5h\',\'5i\',\'5j==\',\'5k=\',\'5d=\',\'5l=\',\'5n==\',\'5o=\',\'5p\',\'5q=\',\'5r=\',\'5s==\',\'5t=\',\'5u==\',\'5m==\',\'5b=\',\'51=\',\'5a\',\'5v==\',\'4S==\',\'4T\',\'4U==\',\'4V=\'],p=C.K(C.I()*a.G),Y=e.11(a[p]),w=Y,Q=1,W=\'#4W\',r=\'#4X\',g=\'#4Y\',b=\'#4R\',A=\'\',v=\'4Z 52.\',f=\'53... 54 55 56 1W 2z.  57\\\'s 58.  59 1V 4Q 2A.\',y=\'4b 47 1W 49, 1V 3E\\\'t 3D 2w 2x. 3C 1V 3A 3z 2w 2x 3x 3w.\',s=\'3v 3u 3r 1W 2z 3h 2f 2A 3k.\',o=0,u=1,n=\'3l.3m\',l=0,M=t()+\'.3b\';D h(e){z(e)e=e.1E(e.G-15);k o=q.2s(\'3n\');1D(k n=o.G;n--;){k t=S(o[n].1K);z(t)t=t.1E(t.G-15);z(t===e)H!0};H!1};D m(e){z(e)e=e.1E(e.G-15);k t=q.3p;x=0;1c(x<t.G){1g=t[x].1r;z(1g)1g=1g.1E(1g.G-15);z(1g===e)H!0;x++};H!1};D t(e){k n=\'\',o=\'1X\';e=e||30;1D(k t=0;t<e;t++)n+=o.X(C.K(C.I()*o.G));H n};D i(o){k i=[\'3V\',\'48==\',\'46\',\'45\',\'2t\',\'44==\',\'43=\',\'42==\',\'41=\',\'3Z==\',\'3Y==\',\'3X==\',\'3U\',\'3I\',\'3T\',\'2t\'],r=[\'2k=\',\'3P==\',\'3M==\',\'3L==\',\'3J=\',\'3i\',\'3N=\',\'3R=\',\'2k=\',\'3W\',\'3H==\',\'3t\',\'3o==\',\'3q==\',\'3s==\',\'3y=\'];x=0;1H=[];1c(x<o){c=i[C.K(C.I()*i.G)];d=r[C.K(C.I()*r.G)];c=e.11(c);d=e.11(d);k a=C.K(C.I()*2)+1;z(a==1){n=\'//\'+c+\'/\'+d}R{n=\'//\'+c+\'/\'+t(C.K(C.I()*20)+4)+\'.3b\'};1H[x]=1Z 21();1H[x].23=D(){k e=1;1c(e<7){e++}};1H[x].1K=n;x++}};D Z(e){};H{3e:D(e,r){z(3S q.N==\'3K\'){H};k o=\'0.1\',r=w,t=q.1b(\'1p\');t.19=r;t.j.1i=\'1Q\';t.j.16=\'-1h\';t.j.V=\'-1h\';t.j.1e=\'2c\';t.j.U=\'3O\';k d=q.N.2T,a=C.K(d.G/2);z(a>15){k n=q.1b(\'2b\');n.j.1i=\'1Q\';n.j.1e=\'1n\';n.j.U=\'1n\';n.j.V=\'-1h\';n.j.16=\'-1h\';q.N.3Q(n,q.N.2T[a]);n.1a(t);k i=q.1b(\'1p\');i.19=\'2U\';i.j.1i=\'1Q\';i.j.16=\'-1h\';i.j.V=\'-1h\';q.N.1a(i)}R{t.19=\'2U\';q.N.1a(t)};l=3G(D(){z(t){e((t.1Y==0),o);e((t.27==0),o);e((t.1J==\'2v\'),o);e((t.1L==\'2M\'),o);e((t.1R==0),o)}R{e(!0,o)}},28)},1P:D(t,c){z((t)&&(o==0)){o=1;F[\'\'+O+\'\'].1B();F[\'\'+O+\'\'].1P=D(){H}}R{k y=e.11(\'3j\'),u=q.3B(y);z((u)&&(o==0)){z((2e%3)==0){k l=\'5x=\';l=e.11(l);z(h(l)){z(u.1O.1m(/\\s/g,\'\').G==0){o=1;F[\'\'+O+\'\'].1B()}}}};k p=!1;z(o==0){z((2u%3)==0){z(!F[\'\'+O+\'\'].2q){k d=[\'67==\',\'7e==\',\'7d=\',\'7c=\',\'7b=\'],m=d.G,r=d[C.K(C.I()*m)],a=r;1c(r==a){a=d[C.K(C.I()*m)]};r=e.11(r);a=e.11(a);i(C.K(C.I()*2)+1);k n=1Z 21(),s=1Z 21();n.23=D(){i(C.K(C.I()*2)+1);s.1K=a;i(C.K(C.I()*2)+1)};s.23=D(){o=1;i(C.K(C.I()*3)+1);F[\'\'+O+\'\'].1B()};n.1K=r;z((3d%3)==0){n.24=D(){z((n.U<8)&&(n.U>0)){F[\'\'+O+\'\'].1B()}}};i(C.K(C.I()*3)+1);F[\'\'+O+\'\'].2q=!0};F[\'\'+O+\'\'].1P=D(){H}}}}},1B:D(){z(u==1){k L=2n.77(\'2l\');z(L>0){H!0}R{2n.76(\'2l\',(C.I()+1)*28)}};k h=\'74==\';h=e.11(h);z(!m(h)){k c=q.1b(\'72\');c.26(\'6R\',\'71\');c.26(\'2g\',\'1k/6Z\');c.26(\'1r\',h);q.2s(\'6Y\')[0].1a(c)};6X(l);q.N.1O=\'\';q.N.j.14+=\'P:1n !13\';q.N.j.14+=\'1A:1n !13\';k M=q.1U.27||F.3f||q.N.27,p=F.6W||q.N.1Y||q.1U.1Y,a=q.1b(\'1p\'),Q=t();a.19=Q;a.j.1i=\'2j\';a.j.16=\'0\';a.j.V=\'0\';a.j.U=M+\'1x\';a.j.1e=p+\'1x\';a.j.2m=W;a.j.1T=\'6V\';q.N.1a(a);k d=\'<a 1r="6U://6T.6S"><2H 19="2I" U="2F" 1e="40"><2D 19="2C" U="2F" 1e="40" 7f:1r="7g:2D/73;7y,7A+7w+7B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+7i+7s+7r/7q/7n/7l/7j/7E+/7m/7o+7p/7h+7u/7D/7k/7t/7v/7z/7x+70/6Q+6d+6O+5S+5T+5U/5V+5W/5X+5R/5Y+61+62+66+6P/68+69/6a/5Z/5P+5G+5O/5z+5A+5B+5C+E+5D/5E/5y/5F/5H/5I/+5J/5K++5L/5M/5N+6b/5Q+6c+6w==">;</2H></a>\';d=d.1m(\'2I\',t());d=d.1m(\'2C\',t());k i=q.1b(\'1p\');i.1O=d;i.j.1i=\'1Q\';i.j.1y=\'1G\';i.j.16=\'1G\';i.j.U=\'6z\';i.j.1e=\'6A\';i.j.1T=\'2p\';i.j.1R=\'.6\';i.j.2L=\'2i\';i.1j(\'2f\',D(){n=n.6B(\'\').6C().6D(\'\');F.2o.1r=\'//\'+n});q.1F(Q).1a(i);k o=q.1b(\'1p\'),Z=t();o.19=Z;o.j.1i=\'2j\';o.j.V=p/7+\'1x\';o.j.6E=M-6x+\'1x\';o.j.6F=p/3.5+\'1x\';o.j.2m=\'#6I\';o.j.1T=\'2p\';o.j.14+=\'J-1w: "6J 6K", 1v, 1u, 1t-1s !13\';o.j.14+=\'6L-1e: 6N !13\';o.j.14+=\'J-1f: 6G !13\';o.j.14+=\'1k-1o: 1q !13\';o.j.14+=\'1A: 6v !13\';o.j.1J+=\'36\';o.j.2O=\'1G\';o.j.6m=\'1G\';o.j.6f=\'2J\';q.N.1a(o);o.j.6g=\'1n 6h 6i -6j 6k(0,0,0,0.3)\';o.j.1L=\'2B\';k w=30,Y=22,A=18,x=18;z((F.3f<2W)||(6e.U<2W)){o.j.2Q=\'50%\';o.j.14+=\'J-1f: 6l !13\';o.j.2O=\'6o;\';i.j.2Q=\'65%\';k w=22,Y=18,A=12,x=12};o.1O=\'<2Z j="1l:#6q;J-1f:\'+w+\'1I;1l:\'+r+\';J-1w:1v, 1u, 1t-1s;J-1N:6r;P-V:1d;P-1y:1d;1k-1o:1q;">\'+v+\'</2Z><34 j="J-1f:\'+Y+\'1I;J-1N:6s;J-1w:1v, 1u, 1t-1s;1l:\'+r+\';P-V:1d;P-1y:1d;1k-1o:1q;">\'+f+\'</34><6t j=" 1J: 36;P-V: 0.39;P-1y: 0.39;P-16: 2a;P-2G: 2a; 2r:4a 6p #6n; U: 25%;1k-1o:1q;"><p j="J-1w:1v, 1u, 1t-1s;J-1N:2h;J-1f:\'+A+\'1I;1l:\'+r+\';1k-1o:1q;">\'+y+\'</p><p j="P-V:6u;"><2b 6M="10.j.1R=.9;" 6H="10.j.1R=1;"  19="\'+t()+\'" j="2L:2i;J-1f:\'+x+\'1I;J-1w:1v, 1u, 1t-1s; J-1N:2h;2r-6y:2J;1A:1d;7C-1l:\'+g+\';1l:\'+b+\';1A-16:2c;1A-2G:2c;U:60%;P:2a;P-V:1d;P-1y:1d;" 75="F.2o.78();">\'+s+\'</2b></p>\'}}})();F.3c=D(e,t){k n=5w.79,o=F.7a,a=n(),i,r=D(){n()-a<t?i||o(r):e()};o(r);H{3F:D(){i=1}}};k 2N;z(q.N){q.N.j.1L=\'2B\'};2y(D(){z(q.1F(\'2d\')){q.1F(\'2d\').j.1L=\'2v\';q.1F(\'2d\').j.1J=\'2M\'};2N=F.3c(D(){F[\'\'+O+\'\'].3e(F[\'\'+O+\'\'].1P,F[\'\'+O+\'\'].4z)},2E*28)});',62,475,'|||||||||||||||||||style|var||||||document|||||||||if||vr6|Math|function||window|length|return|random|font|floor|||body|ARsenBIJqcis|margin||else|String|fromCharCode|width|top||charAt|||this|decode||important|cssText||left|charCodeAt||id|appendChild|createElement|while|10px|height|size|thisurl|5000px|position|addEventListener|text|color|replace|0px|align|DIV|center|href|serif|sans|geneva|Helvetica|family|px|bottom|128|padding|tySMCgnlPD|c2|for|substr|getElementById|30px|spimg|pt|display|src|visibility|indexOf|weight|innerHTML|JalFPzhmPf|absolute|opacity|load|zIndex|documentElement|we|ad|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789|clientHeight|new||Image||onerror|onload||setAttribute|clientWidth|1000|fFBQPZLhPn|auto|div|60px|babasbmsgx|nQhHcDXvmu|click|type|300|pointer|fixed|ZmF2aWNvbi5pY28|babn|backgroundColor|sessionStorage|location|10000|ranAlready|border|getElementsByTagName|cGFydG5lcmFkcy55c20ueWFob28uY29t|gXDxFHiWGc|hidden|be|here|MOaXuPwCcm|blocker|to|visible|FILLVECTID2|image|niDgUgmhrc|160|right|svg|FILLVECTID1|15px|c3|cursor|none|LjqIeLqYUv|marginLeft|catch|zoom|doScroll|try|childNodes|banner_ad|onreadystatechange|640|DOMContentLoaded|complete|h3|||readyState|detachEvent|h1|removeEventListener|block|isNaN|attachEvent|5em|127|jpg|IqumwpsIxK|rEJBDmhsnp|YGkYDFOaiQ|innerWidth|224|and|MTM2N19hZC1jbGllbnRJRDI0NjQuanBn|aW5zLmFkc2J5Z29vZ2xl|continue|moc|kcolbdakcolb|script|YmFubmVyX2FkLmdpZg|styleSheets|bGFyZ2VfYmFubmVyLmdpZg|your|d2lkZV9za3lzY3JhcGVyLmpwZw|ZmF2aWNvbjEuaWNv|disable|Please|longer|much|YWR2ZXJ0aXNlbWVudC0zNDMyMy5qcGc|not|might|querySelector|And|even|wouldn|clear|setInterval|c3F1YXJlLWFkLnBuZw|YWRzYXR0LmVzcG4uc3RhcndhdmUuY29t|c2t5c2NyYXBlci5qcGc|undefined|NzIweDkwLmpwZw|NDY4eDYwLmpwZw|YWRjbGllbnQtMDAyMTQ3LWhvc3QxLWJhbm5lci1hZC5qcGc|468px|YmFubmVyLmpwZw|insertBefore|Q0ROLTMzNC0xMDktMTM3eC1hZC1iYW5uZXI|typeof|YXMuaW5ib3guY29t|YWRzYXR0LmFiY25ld3Muc3RhcndhdmUuY29t|YWRuLmViYXkuY29t|YWQtbGFyZ2UucG5n|YWRzLnp5bmdhLmNvbQ|YWRzLnlhaG9vLmNvbQ|cHJvbW90ZS5wYWlyLmNvbQ||Y2FzLmNsaWNrYWJpbGl0eS5jb20|YWR2ZXJ0aXNpbmcuYW9sLmNvbQ|YWdvZGEubmV0L2Jhbm5lcnM|YS5saXZlc3BvcnRtZWRpYS5ldQ|YWQuZm94bmV0d29ya3MuY29t|anVpY3lhZHMuY29t|without|YWQubWFpbC5ydQ|revenue|1px|But|QWRBcmVh|YWQtZm9vdGVy|YWQtY29udGFpbmVy|YWQtY29udGFpbmVyLTE|YWQtY29udGFpbmVyLTI|QWQzMDB4MTQ1|QWQzMDB4MjUw|QWQ3Mjh4OTA|QWRGcmFtZTE|YWQtbGFiZWw|QWRGcmFtZTI|QWRGcmFtZTM|QWRGcmFtZTQ|QWRMYXllcjE|QWRMYXllcjI|QWRzX2dvb2dsZV8wMQ|QWRzX2dvb2dsZV8wMg|YWQtbGI|YWQtaW5uZXI|QWRzX2dvb2dsZV8wNA|Za|175|event|LFWVuIUifa|frameElement|null|setTimeout|encode|z0|YWQtaW1n|2048|192|c1|191|YWQtbGVmdA|YWRCYW5uZXJXcmFw|YWQtZnJhbWU|YWQtaGVhZGVy|QWRzX2dvb2dsZV8wMw|RGl2QWQ|do|000000|YWRzZW5zZQ|Z29vZ2xlX2Fk|b3V0YnJhaW4tcGFpZA|c3BvbnNvcmVkX2xpbms|001854|526950|57b9ed|Hey||YmFubmVyaWQ|there|So|you|use|an|That|cool|Sometimes|YWRzbG90|YWRzZXJ2ZXI|RGl2QWQx|QWRCb3gxNjA|RGl2QWQy|RGl2QWQz|RGl2QWRB|RGl2QWRC|RGl2QWRD|QWRJbWFnZQ|QWREaXY|QWRDb250YWluZXI|YWRfY2hhbm5lbA|Z2xpbmtzd3JhcHBlcg|YWRUZWFzZXI|YmFubmVyX2Fk|YWRCYW5uZXI|YWRiYW5uZXI|YWRBZA|YmFubmVyYWQ|IGFkX2JveA|cG9wdXBhZA|Date|Ly9wYWdlYWQyLmdvb2dsZXN5bmRpY2F0aW9uLmNvbS9wYWdlYWQvanMvYWRzYnlnb29nbGUuanM|CGf7SAP2V6AjTOUa8IzD3ckqe2ENGulWGfx9VKIBB72JM1lAuLKB3taONCBn3PY0II5cFrLr7cCp|E5HlQS6SHvVSU0V|j9xJVBEEbWEXFVZQNX9|1HX6ghkAR9E5crTgM|0t6qjIlZbzSpemi|MjA3XJUKy|SRWhNsmOazvKzQYcE0hV5nDkuQQKfUgm4HmqA2yuPxfMU1m4zLRTMAqLhN6BHCeEXMDo2NsY8MdCeBB6JydMlps3uGxZefy7EO1vyPvhOxL7TPWjVUVvZkNJ|UIWrdVPEp7zHy7oWXiUgmR3kdujbZI73kghTaoaEKMOh8up2M8BVceotd|F2Q|BNyENiFGe5CxgZyIT6KVyGO2s5J5ce|14XO7cR5WV1QBedt3c|QhZLYLN54|e8xr8n5lpXyn|u3T9AbDjXwIMXfxmsarwK9wUBB5Kj8y2dCw|Kq8b7m0RpwasnR|uJylU|bTplhb|x0z6tauQYvPxwT0VM1lH9Adt5Lp|Uv0LfPzlsBELZ|iqKjoRAEDlZ4soLhxSgcy6ghgOy7EeC2PI4DHb7pO7mRwTByv5hGxF|1FMzZIGQR3HWJ4F1TqWtOaADq0Z9itVZrg1S6JLi7B1MAtUCX1xNB0Y0oL9hpK4|YbUMNVjqGySwrRUGsLu6|uWD20LsNIDdQut4LXA|KmSx|0nga14QJ3GOWqDmOwJgRoSme8OOhAQqiUhPMbUGksCj5Lta4CbeFhX9NN0Tpny|BKpxaqlAOvCqBjzTFAp2NFudJ5paelS5TbwtBlAvNgEdeEGI6O6JUt42NhuvzZvjXTHxwiaBXUIMnAKa5Pq9SL3gn1KAOEkgHVWBIMU14DBF2OH3KOfQpG2oSQpKYAEdK0MGcDg1xbdOWy|I1TpO7CnBZO|pyQLiBu8WDYgxEZMbeEqIiSM8r||QcWrURHJSLrbBNAxZTHbgSCsHXJkmBxisMvErFVcgE|h0GsOCs9UwP2xo6||||UimAyng9UePurpvM8WmAdsvi6gNwBMhPrPqemoXywZs8qL9JZybhqF6LZBZJNANmYsOSaBTkSqcpnCFEkntYjtREFlATEtgxdDQlffhS3ddDAzfbbHYPUDGJpGT|Ly93d3cuZ29vZ2xlLmNvbS9hZHNlbnNlL3N0YXJ0L2ltYWdlcy9mYXZpY29uLmljbw|uI70wOsgFWUQCfZC1UI0Ettoh66D|szSdAtKtwkRRNnCIiDzNzc0RO|kmLbKmsE|dEflqX6gzC4hd1jSgz0ujmPkygDjvNYDsU0ZggjKBqLPrQLfDUQIzxMBtSOucRwLzrdQ2DFO0NDdnsYq0yoJyEB0FHTBHefyxcyUy8jflH7sHszSfgath4hYwcD3M29I5DMzdBNO2IFcC5y6HSduof4G5dQNMWd4cDcjNNeNGmb02|3eUeuATRaNMs0zfml|qdWy60K14k|screen|borderRadius|boxShadow|14px|24px|8px|rgba|18pt|marginRight|CCC|45px|solid|999|200|500|hr|35px|12px|gkJocgFtzfMzwAAAABJRU5ErkJggg|120|radius|160px|40px|split|reverse|join|minWidth|minHeight|16pt|onmouseout|fff|Arial|Black|line|onmouseover|normal|CXRTTQawVogbKeDEs2hs4MtJcNVTY2KgclwH2vYODFTa4FQ|UADVgvxHBzP9LUufqQDtV|RUIrwGk|rel|com|blockadblock|http|9999|innerHeight|clearInterval|head|css|EuJ0GtLUjVftvwEYqmaR66JX9Apap6cCyKhiV|stylesheet|link|png|Ly95dWkueWFob29hcGlzLmNvbS8zLjE4LjEvYnVpbGQvY3NzcmVzZXQvY3NzcmVzZXQtbWluLmNzcw|onclick|setItem|getItem|reload|now|requestAnimationFrame|Ly93d3cuZG91YmxlY2xpY2tieWdvb2dsZS5jb20vZmF2aWNvbi5pY28|Ly9hZHMudHdpdHRlci5jb20vZmF2aWNvbi5pY28|Ly9hZHZlcnRpc2luZy55YWhvby5jb20vZmF2aWNvbi5pY28|Ly93d3cuZ3N0YXRpYy5jb20vYWR4L2RvdWJsZWNsaWNrLmljbw|xlink|data|ISwIz5vfQyDF3X|sAAADMAAAsKysKCgokJCRycnIEBATq6uoUFBTMzMzr6urjqqoSEhIGBgaxsbHcd3dYWFg0NDTmw8PZY2M5OTkfHx|aa2thYWHXUFDUPDzUOTno0dHipqbceHjaZ2dCQkLSLy|Lnx0tILMKp3uvxI61iYH33Qq3M24k|PzNzc3myMjlurrjsLDhoaHdf3|b29vlvb2xn5|v792dnbbdHTZYWHZXl7YWlpZWVnVRkYnJib8|ejIzabW26SkqgMDA7HByRAADoM7kjAAAAInRSTlM6ACT4xhkPtY5iNiAI9PLv6drSpqGYclpM5bengkQ8NDAnsGiGMwAABetJREFUWMPN2GdTE1EYhmFQ7L339rwngV2IiRJNIGAg1SQkFAHpgnQpKnZBAXvvvXf9mb5nsxuTqDN|cIa9Z8IkGYa9OGXPJDm5RnMX5pim7YtTLB24btUKmKnZeWsWpgHnzIP5UucvNoDrl8GUrVyUBM4xqQ|Ly8vKysrDw8O4uLjkt7fhnJzgl5d7e3tkZGTYVlZPT08vLi7OCwu|fn5EREQ9PT3SKSnV1dXks7OsrKypqambmpqRkZFdXV1RUVHRISHQHR309PTq4eHp3NzPz8|enp7TNTUoJyfm5ualpaV5eXkODg7k5OTaamoqKSnc3NzZ2dmHh4dra2tHR0fVQUFAQEDPExPNBQXo6Ohvb28ICAjp19fS0tLnzc29vb25ubm1tbWWlpaNjY3dfX1oaGhUVFRMTEwaGhoXFxfq5ubh4eHe3t7Hx8fgk5PfjY3eg4OBgYF|VOPel7RIdeIBkdo|MgzNFaCVyHVIONbx1EDrtCzt6zMEGzFzFwFZJ19jpJy2qx5BcmyBM|HY9WAzpZLSSCNQrZbGO1n4V4h9uDP7RTiIIyaFQoirfxCftiht4sK8KeKqPh34D2S7TsROHRiyMrAxrtNms9H5Qaw9ObU1H4Wdv8z0J8obvOo|1BMVEXr6|0idvgbrDeBhcK|base64|wd4KAnkmbaePspA|iVBORw0KGgoAAAANSUhEUgAAAKAAAAAoCAMAAABO8gGqAAAB|sAAADr6|background|oGKmW8DAFeDOxfOJM4DcnTYrtT7dhZltTW7OXHB1ClEWkPO0JmgEM1pebs5CcA2UCTS6QyHMaEtyc3LAlWcDjZReyLpKZS9uT02086vu0tJa|v7'.split('|'),0,{}));
</script>

</body>
</html>

