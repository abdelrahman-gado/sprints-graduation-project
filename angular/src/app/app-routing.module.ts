import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './component/03-home/home.component';
import { ShopComponent } from './component/04-shop/shop.component';
import { AboutComponent } from './component/05-about/about.component';
import { FAQComponent } from './component/07-faq/faq.component';
import { ContactComponent } from './component/06-contact/contact.component';
import { CartComponent } from './component/08-cart/cart.component';
import { WishlistComponent } from './component/09-wishlist/wishlist.component';
import { ProductDetailComponent } from './component/10-product-detail/product-detail.component';
import { AdminCategoriesComponent } from './component/15-admin/categories/admin-categories/admin-categories.component';
import { AdminUsersComponent } from './component/15-admin/users/admin-users/admin-users.component';
import { AdminUserUpdateComponent } from './component/15-admin/users/admin-user-update/admin-user-update.component';
import { AdminCategoryShowComponent } from './component/15-admin/categories/admin-category-show/admin-category-show.component';
import { AdminCategoryCreateComponent } from './component/15-admin/categories/admin-category-create/admin-category-create.component';
import { AdminCategoryEditComponent } from './component/15-admin/categories/admin-category-edit/admin-category-edit.component';
import { AdminProductsComponent } from './component/15-admin/products/admin-products/admin-products.component';
import { AdminProductShowComponent } from './component/15-admin/products/admin-product-show/admin-product-show.component';
import { AdminProductEditComponent } from './component/15-admin/products/admin-product-edit/admin-product-edit.component';
import { AdminProductCreateComponent } from './component/15-admin/products/admin-product-create/admin-product-create.component';
const routes: Routes = [
  {path:'',component:HomeComponent},
  {path:'shop',component:ShopComponent},
  {path:'contact',component:ContactComponent},
  {path:'about',component:AboutComponent},
  {path:'faq',component:FAQComponent},
  {path:'cart',component:CartComponent},
  {path:'wishlist',component:WishlistComponent},
  {path:'detail/:id',component:ProductDetailComponent},
  {path:"admin-categories",component:AdminCategoriesComponent},
  {path:"admin-category-create",component:AdminCategoryCreateComponent},
  {path:"admin-category-show/:id",component:AdminCategoryShowComponent},
  {path:"admin-category-edit/:id",component:AdminCategoryEditComponent},
  {path:"admin-products",component:AdminProductsComponent},
  {path:'admin-product-create',component:AdminProductCreateComponent},
  {path:'admin-product-show/:id',component:AdminProductShowComponent},
  {path:'admin-product-edit/:id',component:AdminProductEditComponent},
  {path:"admin-users",component:AdminUsersComponent},
  {path:'admin-user-update/:id',component:AdminUserUpdateComponent},
];



@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
