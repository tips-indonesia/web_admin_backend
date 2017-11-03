<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <!-- Main -->
                    @include('admin.menuitem', ['items' => $Sidebar->roots()])
                </ul>
            </div>
        </div>

    </div>
</div>