import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './component/01-header/header.component';
import { FooterComponent } from './component/02-footer/footer.component';
import { HomeComponent } from './component/03-home/home.component';
import { ShopComponent } from './component/04-shop/shop.component';
import { AboutComponent } from './component/05-about/about.component';
import { FAQComponent } from './component/07-faq/faq.component';
import { ContactComponent } from './component/06-contact/contact.component';
import { CartComponent } from './component/08-cart/cart.component';
import { WishlistComponent } from './component/09-wishlist/wishlist.component';
import { ProductDetailComponent } from './component/10-product-detail/product-detail.component';
import { CategoriesComponent } from './component/11-categories/categories.component';
import { CategoryComponent } from './component/11-categories/category/category.component';
import { ProductShopComponent } from './component/12-products/product-shop/product-shop.component';
import { NewArrivalsComponent } from './component/12-new-arrivals/new-arrivals.component';
import { NewProductComponent } from './component/12-new-arrivals/new-product/new-product.component';
import { RecommendedProductsComponent } from './component/14-recommended-products/recommended-products.component';
import { ProductComponent } from './component/14-recommended-products/product/product.component';
import { TrendingComponent } from './component/13-trending/trending.component';
import { TrendingProductComponent } from './component/13-trending/trending-product/trending-product.component';
import { AdminUsersComponent } from './component/15-admin/users/admin-users/admin-users.component';
import { AdminUserUpdateComponent } from './component/15-admin/users/admin-user-update/admin-user-update.component';
import { AdminCategoriesComponent } from './component/15-admin/categories/admin-categories/admin-categories.component';
import { AdminCategoryShowComponent } from './component/15-admin/categories/admin-category-show/admin-category-show.component';
import { AdminCategoryCreateComponent } from './component/15-admin/categories/admin-category-create/admin-category-create.component';
import { AdminCategoryEditComponent } from './component/15-admin/categories/admin-category-edit/admin-category-edit.component';
import { AdminProductsComponent } from './component/15-admin/products/admin-products/admin-products.component';
import { AdminProductEditComponent } from './component/15-admin/products/admin-product-edit/admin-product-edit.component';
import { AdminProductShowComponent } from './component/15-admin/products/admin-product-show/admin-product-show.component';
import { CartTableComponent } from './component/08-cart/cart-table/cart-table.component';
import { CartTotalComponent } from './component/08-cart/cart-total/cart-total.component';
import { AdminProductCreateComponent } from './component/15-admin/products/admin-product-create/admin-product-create.component';


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    HomeComponent,
    ShopComponent,
    AboutComponent,
    FAQComponent,
    AboutComponent,
    ContactComponent,
    CartComponent,
    WishlistComponent,
    ProductDetailComponent,
    CategoriesComponent,
    CategoryComponent,
    ProductComponent,
    ProductShopComponent,
    NewArrivalsComponent,
    NewProductComponent,
    RecommendedProductsComponent,
    ProductComponent,
    TrendingComponent,
    TrendingProductComponent,
    AdminCategoriesComponent,
    AdminProductsComponent,
    AdminUsersComponent,
    AdminUserUpdateComponent,
    AdminProductEditComponent,
    AdminProductShowComponent,
    AdminCategoryShowComponent,
    AdminCategoryEditComponent,
    CartTableComponent,
    CartTotalComponent,
    AdminCategoryCreateComponent,
    AdminProductCreateComponent,
  ],
  imports: [BrowserModule, AppRoutingModule, HttpClientModule, FormsModule, ReactiveFormsModule],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
