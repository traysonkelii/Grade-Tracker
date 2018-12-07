<byu-header>
    <span slot="site-title">Music Department</span>
    <byu-search slot="search" action="https://www.google.com/#q=$1" method="get" placeholder="Search"></byu-search>
    <byu-user-info slot="user">
    <!-- TODO use BYU api to make the login work -->
        <a slot="login" href="#login">Sign In</a>
        <a slot="logout" href="#logout">Sign Out</a>
    </byu-user-info>
    <!-- TODO make a javascript file that adds the class active "after" a click -->
    <byu-menu slot="nav" class="transparent">
        <a href="/">Login</a>
        <a href="{{ route('jury-form')}}">Jury Form Builder</a>
        <a href="{{ route('jury-assign')}}">Jury Assignments</a>
    </byu-menu>
</byu-header>
