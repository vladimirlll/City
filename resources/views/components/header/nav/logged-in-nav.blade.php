<nav class="nav">
    <x-header.nav.link link="/catalog/all" linkText="Каталог специалистов" />
    <x-header.nav.link link="/#about" linkText="О платформе" />
    <x-header.nav.link link="/#contacts" linkText="Контакты"/>
    <x-header.nav.drop-down-link :linkText="$linkText" :dropedLinks="$dropedLinks" />
</nav>