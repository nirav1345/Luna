<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Luna</title>
    <meta name="description" content="Hi, I'm Luna. Your music buddy that feels your vibe. ">
<style>
  html {
    scroll-behavior: smooth;
  }
</style>
  <!-- Stylesheets -->
  <link rel="stylesheet" href="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/css/deeploy-scotty.webflow.a549a5cbe.css" type="text/css">
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">
    WebFont.load({
      google: {
        families: ["IBM Plex Mono:100,200,300,regular,500,600,700"]
      }
    });
  </script>

  <script type="text/javascript">
    !function(o, c) {
      var n = c.documentElement, t = " w-mod-";
      n.className += t + "js";
      ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch");
    }(window, document);
  </script>

  <!-- Favicon & Apple Touch Icon -->
  <link rel="shortcut icon" type="image/x-icon" href="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fbd076b8af2de62a58babdc_Favicon.png">
  <link rel="apple-touch-icon" href="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fbd081f7534b09e8a678e7e_WebClip.png">
</head>

<body class="scottybody">
  <!-- Navigation -->
  <div data-collapse="medium" data-animation="default" data-duration="400" data-doc-height="1" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
    <a href="/" aria-current="page" class="scottyheaderlogo w-nav-brand w--current">
<img src="/assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fbd03f28330854200a49d07_BrandScotty_Green.png" alt="Bot Avatar">
    </a>

    <div class="container w-container">
      <div class="menu-button w-nav-button">
        <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f230523ea7e929b10125139_MENU.svg" alt="" class="hamburger">
      </div>

      <nav role="navigation" class="nav-menu w-nav-menu">
        <div class="mainmenu">
          <a href="index.html" class="nav-link w-nav-link w--current">LUNA</a>
          <a href="#Partners" class="nav-link w-nav-link">COMPANY</a>
          <a href="tel:+31308773572" class="menuunit call w-inline-block">
            <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f2d2698e09a283d6785f17e_IconCall.svg" alt="" class="menuicon">
          </a>
          <a href="mailto:hello@scottytechnologies.com" class="menuunit w-inline-block">
            <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f2d2698bcf1a64d708596db_IconMail.svg" alt="" class="menuicon">
            <h3 class="menutext">e-mail us</h3>
          </a>
          <a href="https://open.spotify.com/" class="menuunit w-inline-block">
            <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f2d2698d6b1b55992dc3619_IconChat.svg" alt="" class="menuicon">
            <h3 class="menutext">SPOTIFY</h3>
          </a>
        </div>
      </nav>
    </div>

    <div class="menucontainer mobile">
      <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f4913b78f74bb902babe64c_MenuShape.svg" alt="" class="menushape">
    </div>
  </div>

  <!-- Floating CTA -->
  <a href="/chat" class="scottychatcta offhome w-inline-block">
    <h1 class="chatctatext">TALK TO<br>SCOTTY</h1>
    <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f44e5745427b8438f73b3fc_CTAchat.svg" alt="" class="hexagon_chatcta">
  </a>

  <!-- Anchors -->
  <div class="menuanchors">
    <div class="anchorscontainer">
      <a href="#Home" class="anchorbutton w-inline-block"></a>
      <a href="#Who-Am-I" class="anchorbutton w-inline-block"></a>
      <a href="#How-Do-I-Work" class="anchorbutton w-inline-block"></a>
      <a href="#WhoAmIFor" class="anchorbutton w-inline-block"></a>
    </div>
  </div><div class="chatbox">
  <div class="chatboxcontainer">
    <div class="chatboxunit">

<!-- ✅ Chat Body -->
<div class="chatbody" id="chat-body">
  <!-- Initial Bot Message -->
  <div class="chattext_bot">
    <div class="avatar bot">
      <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fbd03f3d83094e45ca0dc53_BrandScotty_Symbol.svg" alt="Bot Avatar">
    </div>
    <h2 class="chattext bot">
      Hi, I’m Luna.<br><br>
      You can share how you feel 🎧<br>
      I’ll find songs that fit your mood. Just type a few words.<br><br>
      I’ll do the rest. Let’s vibe!<br>
    </h2>
  </div>
</div>

<!-- ✅ Chat Input -->
<div class="chatinput">
  <form id="email-form" class="chatform" action="#" method="POST">
    <input
      type="text"
      class="chatinputarea"
      maxlength="256"
      name="Chat"
      id="Chat"
      placeholder="Please type here"
      required
    >
    <button type="submit" class="chatbutton">SEND</button>
  </form>
</div>
    </div>
  </div>
</div>

<!-- Home Section -->
<div id="Home" class="home wf-section">
  <div class="homecontainer">
    <div class="leftcontainer homeintro">
      <div class="homeinfo">
        <div class="hometitle">
          Hi, I'm luna. Your music buddy that feels your vibe.

        </div>
        <div class="homecta">
          <a href="#" class="ctahomemobile w-button">Try me now</a>
          <div class="homectatext">Try me now!</div>
          <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f21a7da28b7982b6bbe32cb_ArrowGreen.svg" alt="" class="image-3">
        </div>
      </div>
      <div class="circleicons">
        <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f3e9c546ddba830f8b89fe7_CircleIcons.svg" alt="">
      </div>
    </div>
  </div>
</div>

<!-- Who Am I Section -->
<div id="Who-Am-I" class="whoami wf-section">
  <div class="sectioncontainer">
    <div class="leftcontainer">
      <h1>I am a great music buddy.</h1>
      <h2 class="subtitlewhoami">
        I service your customers, colleagues and partners 24/7.
      </h2>

      <div class="howunit">
        <div class="howunitinfocontainer">
          <h2 class="subtitlehow whoami">I am a great Music recommender.</h2>
          <h3>
            My mission is to suggest you the best songs that suit your mood.
          </h3>
        </div>
        <div class="howhexagon">
          <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f44e57584ac6bba5fdfb55c_hexagon02.svg" alt="">
        </div>
      </div>

      <div class="howunit">
        <div class="howunitinfocontainer">
          <h2 class="subtitlehow whoami">I tune into your emotions to soundtrack your moments.</h2>
          <h3>
            I enhance your music experience by understanding your mood. Based on the emotional inputs you provide, I recommend songs that resonate with how you're feeling — in real time. My Mood Indicators analyze your mood selections to deliver personalized playlists that match your vibe. Discover what lifts your spirits, calms your mind, or energizes your day — and let your music adapt to you, now and in the moments to come.


          </h3>
        </div>
        <div class="howhexagon">
          <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f44e57584ac6bba5fdfb55c_hexagon02.svg" alt="">
        </div>
      </div>
    </div>

    <div data-w-id="e15b94b5-e401-48c6-fe67-6f274fa9da14" class="hexagonparallax">
      <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f48f6c3aa6de07fe3b2fc52_HexagonBrands_Green.svg" alt="">
    </div>
  </div>
</div>

<!-- How Do I Work Section -->
<div id="How-Do-I-Work" class="howdoiwork wf-section">
  <div class="sectioncontainer">
    <div class="leftcontainer"><h1>I make music personal for you.<br></h1>

<div class="howunit">
  <div class="howunitinfocontainer">
    <h2 class="subtitlehow">I take away the guesswork.</h2>
    <h3>
      I come as a smart music companion that handles all the mood-matching for you — just select how you feel, and I’ll deliver songs that suit your emotional state, so you can relax and enjoy your day.


    </h3>
  </div>
  <div class="howhexagon">
    <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f44e57584ac6bba5fdfb55c_hexagon02.svg" alt="">
  </div>
</div>

<div class="howunit">
  <div class="howunitinfocontainer">
    <h2 class="subtitlehow">Mood-based listening, no extra effort.</h2>
    <h3>
      I work on a mood-first, seamless experience model. With no setup needed, you get instant access to personalized playlists — giving you great musical value and emotional connection from the very first song.
    </h3>
  </div>
  <div class="howhexagon">
    <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f44e57584ac6bba5fdfb55c_hexagon02.svg" alt="">
  </div>
</div>
</div> <!-- End of .leftcontainer -->
</div> <!-- End of .sectioncontainer -->
</div> <!-- End of #How-Do-I-Work -->

<!-- Who Am I For Section -->
<div id="WhoAmIFor" class="whoamifor wf-section">
  <div class="sectioncontainer">
    <div class="leftcontainer">
      <h1 class="whitetitle">Typical experience i create.</h1>

      <div class="whoamiforunit">
        <div class="whoamiforinfo">
          <h2 class="whitesubtitle">Mood driven<br>playlists</h2>
          <h3 class="whitetext">
            Music lovers enjoy my recommendations because I help them discover tracks that truly match how they feel. No more endless scrolling, skipping songs, or guessing what fits the mood — I deliver the right sound at the right moment.

Not only do listeners love me, but creators and platforms benefit too. I help them reach the right audience effortlessly by turning emotional input into musical connection.


          </h3>
        </div>
        <div class="iconwhoamifor">
          <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f21e44e60107f00acfe44e3_iconEcommerce.svg" alt="">
        </div>
        <div class="hexagondegrade">
          <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f44e5755427b848ec73b40e_hexagonDegrade.svg" alt="" class="hexagonicon">
        </div>
      </div>

      <div class="whoamiforunit">
        <div class="whoamiforinfo">
          <h2 class="whitesubtitle">Engagement and<br>discovery</h2>
          <h3 class="whitetext">
            My mission is to be your personal music guide — introducing you to new artists, genres, and sounds that match your emotional landscape.

Whether you're chilling, focused, or fired up, I recommend tracks 24/7 in any genre, for any vibe — turning every moment into a perfect soundtrack.


          </h3>
        </div>
        <div class="iconwhoamifor">
          <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f21e44e7cf4159170f9e650_IconCustomerService.svg" alt="">
        </div>
        <div class="hexagondegrade">
          <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f44e5755427b848ec73b40e_hexagonDegrade.svg" alt="" class="hexagonicon">
        </div>
      </div>
    </div>
  </div>
</div>



<div class="takeaways wf-section">
  <div class="sectioncontainer">
    <div class="leftcontainer">
      <h1>Scotty Key Takeaways<br></h1>

      

      <div class="takeawaysunit">
        <div class="t_top">
          <div class="t_topleft">
            <h2 class="t_subtitle">Value</h2>
            <div class="text-block">(for Music listeners)</div>
          </div>
          <div class="t_icon">
            <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fd74c0bc1a06b78b2f27e6b_icon_Takeaways_01.svg" loading="lazy" alt="">
          </div>
        </div>
        <div class="t_bottom value">
          <div class="t_numbers _20">>70% accuracy in detecting user mood from text input</div>
          <div class="t_wdivider"></div>
          <div class="t_numbers _20">Enhanced emotional connection through mood-aligned songs</div>
          <div class="t_wdivider"></div>
          <div class="t_numbers _20">Reduced Customer Effort</div>
          <div class="t_wdivider"></div>
          <div class="t_numbers _20">Better understanding</div>
        </div>
      </div>

      <div class="takeawaysunit">
        <div class="t_top">
          <h2 class="t_subtitle">Founders</h2>
          <div class="t_icon">
            <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fd74c0b5a7550e75dde9aa9_icon_Takeaways_02.svg" loading="lazy" alt="">
          </div>
        </div>
        <div class="t_bottom founders">
          <div class="t_bottomunit">
            <h5 class="t_label">ceo</h5>
            <div class="t_numbers _26">Pushkar<br>Mhatre</div>
          </div>
          <div class="t_vdivider"></div>
          <div class="t_bottomunit">
            <h5 class="t_label">cto</h5>
            <div class="t_numbers _26">Nirav<br>Thakur</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div id="LetsTalk" class="letstalk wf-section">
  <div class="sectioncontainer">
    <div class="leftcontainer">
      <h1 class="letstalktitle">Ask me to do the math together with you<br></h1>
      <div class="homecta talk">
        <div class="homectatext talk">Start here</div>
        <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f21a7da5bf75737563d09d9_ArrowWhite.svg" alt="" class="image-3">
      </div>
      <h3 class="texttalk">
        If you ask me in the chat, I will help you figure out what song you should listen to depending upon your mood.
      </h3>
    </div>
  </div>
</div>

<div id="Diaries" class="scottydiaries wf-section">
  <div class="sectioncontainer">
    <div class="leftcontainer">
      <div class="logoscottydiaries">
        <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fbd03f24f6f874b08a608f3_BrandScotty_Diaries.svg" loading="lazy" alt="">
      </div>
      <h3>
        I provide your customers with the easiest and most remarkable customer service, but here, I just got launched and I am learning new things from every conversation.<br><br>
        <strong><em>I’ve decided to stand up and show the world how I am improving every day and I am telling all about it in Scotty Diaries.</em></strong><br><br>
        It has been a fun journey, people ask me crazy things like “what can you eat” or they get philosophical and want me to answer “what’s the meaning of life”.<br><br>
        Wanna be part of my journey?<br><strong>Read my diaries on LinkedIn.</strong>
      </h3>
      <div class="cta_diariescontainer">
        <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f69cd84727b7b1f5524e4f4_Diaries%20Arrow.svg" loading="lazy" alt="" class="arrowdiaries">
        <a href="https://www.linkedin.com/feed/update/urn:li:activity:6712748244277039104" target="_blank" class="ctaopportunities diaries w-button">Read my Diaries</a>
      </div>
    </div>
  </div>
  <div class="diariescontainer">
    <div class="diariesillustration">
      <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f69ffb3b804c911e30876c5_Diaries_1.svg" loading="lazy" alt="">
    </div>
  </div>
</div>

<div id="Partners" class="footer wf-section">
  <div class="footerinfo">
    <div class="footercontainer">
      <div class="leftcontainer footer">
        <div class="scottylogofooter">
          <img src="/assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fbd03f28330854200a49d07_BrandScotty_Green.png" alt="Bot Avatar">
        </div>
        <div class="footerinfocontainer">
          <h3 class="footertitle">Company</h3>
          <h3 class="footertext">Luna - The makers of Luna<br></h3>

          <h3 class="footertitle">Direct Contacts</h3>
          <h3 class="footertext">
            +91 9326383279<br>
            pushkarmhatre424@gmail.com
          </h3>

          <h3 class="footertitle">Offices</h3>
          <h3 class="footertext">
            Uran, Panvel<br>
          
          </h3>

          <div class="socialcontainer">
            <div class="social">
              <a href="https://api.whatsapp.com/send?phone=3197008100084" target="_blank" class="sociallink w-inline-block">
                <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f50cdb5caa9d6f0300feeb6_WA.svg" alt="">
              </a>
              <a href="http://linkedin.com/company/scotty-technologies" target="_blank" class="sociallink w-inline-block">
                <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5f50d873a0c67e5a7ead1c3b_LinkedIn.svg" alt="">
              </a>
              <a href="https://medium.com/@scottytechnologies" target="_blank" class="sociallink medium w-inline-block">
                <img src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fbd0660671b7fadeb2bd3c9_Medium.svg" alt="">
              </a>
            </div>
            <h3 class="footertext copyright">Copyright 2025. Luna.</h3>
          </div>

          <a href="/privacy-policy" class="privacypolicybutton w-inline-block">
            <h3 class="footertext single">Privacy Policy</h3>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/js/webflow.226f03325.js" type="text/javascript"></script>
</body>
<script src="script.js"></script></html>