<div class="side-nav-content relative side-nav-scroll">
							<nav class="menu menu-transparent px-4 pb-4">
								<div class="menu-group">
									<div class="menu-title">{{ ucwords(Auth::user()->type) }} PANEL</div>
									<ul>
									    <li data-menu-item="classic-welcome" class="menu-item menu-item-single mb-2">
											<a class="menu-item-link" href="{{ route('admin.dashboard') }}">
												<svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
												</svg>
												<span class="menu-item-text">Dashboard</span>
											</a>
										</li>
										<li data-menu-item="classic-documentation" class="menu-item menu-item-single mb-2">
    											<a class="menu-item-link" href="{{ route('admin.book') }}">
    											    <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                                                    </svg>
    												<span class="menu-item-text">Bookings</span>
    											</a>
    										</li>
										<li data-menu-item="classic-welcome" class="menu-item menu-item-single mb-2">
											<a class="menu-item-link" href="{{ route('admin.franchise') }}">
											    <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5"></path>
                                                </svg>
												<span class="menu-item-text">Franshice Applications</span>
											</a>
										</li>
										<li data-menu-item="classic-documentation" class="menu-item menu-item-single mb-2">
    											<a class="menu-item-link" href="{{ route('admin.imagegallery') }}">
    											    <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                                                    </svg>
    												<span class="menu-item-text">Image Gallery</span>
    											</a>
    										</li>
    											<li data-menu-item="classic-documentation" class="menu-item menu-item-single mb-2">
    											<a class="menu-item-link" href="{{ route('admin.VideoGallery') }}">
    											    <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                                                    </svg>
    												<span class="menu-item-text">Video Gallery</span>
    											</a>
    										</li>
										<!--<li class="menu-collapse">-->
										<!--	<div class="menu-collapse-item">-->
										<!--		<svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">-->
										<!--			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>-->
										<!--		</svg>-->
										<!--		<span class="menu-item-text">Sales</span>-->
										<!--	</div>-->
										<!--	<ul>-->
										<!--		<li data-menu-item="classic-sales-dashboard" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-sales-dashboard.html">-->
										<!--				<span>Dashboard</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-product-list" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-product-list.html">-->
										<!--				<span>Product List</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-product-edit" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-product-edit.html">-->
										<!--				<span>Product Edit</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-new-product" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-new-product.html">-->
										<!--				<span>New Product</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-order-list" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-order-list.html">-->
										<!--				<span>Order List</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-order-details" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-order-details.html">-->
										<!--				<span>Order Details</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--	</ul>-->
										<!--</li>-->
										<!--<li class="menu-collapse">-->
										<!--	<div class="menu-collapse-item">-->
										<!--		<svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">-->
										<!--			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>-->
										<!--		</svg>-->
										<!--		<span class="menu-item-text">Crypto</span>-->
										<!--	</div>-->
										<!--	<ul>-->
										<!--		<li data-menu-item="classic-crypto-dashboard" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-crypto-dashboard.html">-->
										<!--				<span>Dashboard</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-portfolio" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-portfolio.html">-->
										<!--				<span>Portfolio</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-market" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-market.html">-->
										<!--				<span>Market</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-wallets" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-wallets.html">-->
										<!--				<span>Wallets</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--	</ul>-->
										<!--</li>-->
										<!--<li class="menu-collapse">-->
										<!--	<div class="menu-collapse-item">-->
										<!--		<svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">-->
										<!--			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>-->
										<!--		</svg>-->
										<!--		<span class="menu-item-text">Knowledge Base</span>-->
										<!--	</div>-->
										<!--	<ul>-->
										<!--		<li data-menu-item="classic-help-center" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-help-center.html">-->
										<!--				<span>Help Center</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-article" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-article.html">-->
										<!--				<span>Article</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-manage-articles" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-manage-articles.html">-->
										<!--				<span>Manage Articles</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-edit-article" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-edit-article.html">-->
										<!--				<span>Edit Article</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--	</ul>-->
										<!--</li>-->
										<!--<li class="menu-collapse">-->
										<!--	<div class="menu-collapse-item">-->
										<!--		<svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">-->
										<!--			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>-->
										<!--		</svg>-->
										<!--		<span class="menu-item-text">Account</span>-->
										<!--	</div>-->
										<!--	<ul>-->
										<!--		<li data-menu-item="classic-settings" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-settings.html">-->
										<!--				<span>Settings</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-invoice" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-invoice.html">-->
										<!--				<span>Invoice</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-activity-log" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center" href="classic-activity-log.html">-->
										<!--				<span>Activity Log</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--		<li data-menu-item="classic-kyc-form" class="menu-item">-->
										<!--			<a class="h-full w-full flex items-center"  href="classic-kyc-form.html">-->
										<!--				<span>KYC Form</span>-->
										<!--			</a>-->
										<!--		</li>-->
										<!--	</ul>-->
										<!--</li>-->
									</ul>
								</div>
							</nav>	
						</div>