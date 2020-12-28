<aside class="main-sidebar sidebar-light-navy elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('img/books.png') }}" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">E-Library</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ Request::is('book') || Request::is('book/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('book') || Request::is('book/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Books
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('book.index') }}" class="nav-link {{ Request::is('book') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show Books</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('book.create') }}" class="nav-link {{ Request::is('book/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Book</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ Request::is('member') || Request::is('member/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('member') || Request::is('member/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Members
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('member.index') }}" class="nav-link {{ Request::is('member') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show Members</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('member.create') }}" class="nav-link {{ Request::is('member/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Member</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ Request::is('transaction') || Request::is('transaction/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('transaction') || Request::is('transaction/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Transactions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('transaction.index') }}" class="nav-link {{ Request::is('transaction') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show Transactions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaction.create') }}" class="nav-link {{ Request::is('transaction/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Transaction</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('report.index') }}" class="nav-link {{ Request::is('report') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-pdf"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
