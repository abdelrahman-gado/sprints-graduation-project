import { Component } from '@angular/core';
import { Product } from 'src/app/interface/product';
import { productNav } from 'src/app/interface/productNav';
import { ProductService } from 'src/app/service/product/product.service';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { CategoryService } from 'src/app/service/category/category.service';
import { Category } from 'src/app/interface/category';
import { ColorService } from 'src/app/service/color/color.service';
import { Color } from 'src/app/interface/color';
import { environment } from 'src/app/environment/environment';

@Component({
  selector: 'app-shop',
  templateUrl: './shop.component.html',
  styleUrls: ['./shop.component.css'],
})
export class ShopComponent {
  products: Product[] = [];
  categories: Category[] = [];
  colors: Color[] = [];
  nav: productNav = {} as productNav;
  page: any;
  apiUrl: string = environment.apiUrl;
  selectedColors: any;
  selectedCatgeories: any;
  selectedPrice: any;

  constructor(
    private productService: ProductService,
    private categoryService: CategoryService,
    private colorService: ColorService,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.route.queryParams.subscribe((params) => {
      this.page = params['page'] || '1';
      this.selectedColors = params['color'] || '';
      this.selectedCatgeories = params['category'] || '';
      this.selectedPrice = parseFloat(params['price']) || 0;

      
      this.productService
        .getShopProducts(
          this.page,
          this.selectedColors,
          this.selectedCatgeories,
          this.selectedPrice
        )
        .subscribe((data: any) => {
          this.products = data.data;
          this.nav.current_page = data.current_page;
          this.nav.first_page_url = data.first_page_url;
          this.nav.from = data.from;
          this.nav.last_page = data.last_page;
          this.nav.last_page_url = data.last_page_url;
          this.nav.pre_next_links = [
            data.links[0],
            data.links[data.links.length - 1],
          ].map((item: any) => {
            item.url = decodeURIComponent(item.url).replaceAll(
              /\[[0-9]\]/g,
              ''
            );
            return item;
          });
          this.nav.num_links = data.links
            .slice(1, data.links.length - 1)
            .map((item: any) => {
              item.url = decodeURIComponent(item.url).replaceAll(
                /\[[0-9]\]/g,
                ''
              );
              return item;
            });
          this.nav.next_page_url = data.next_page_url;
          this.nav.path = data.path;
          this.nav.per_page = data.per_page;
          this.nav.prev_page_url = data.prev_page_url;
          this.nav.to = data.to;
          this.nav.total = data.total;
        });
    });

    this.categoryService.getCategories().subscribe((data: any) => {
      this.categories = data.data;
    });

    this.colorService.getColors().subscribe((data: any) => {
      this.colors = data;
    });
  }

  getParams(): any {
    this.route.queryParams.subscribe((params) => {
      this.page = params['page'];
      console.log(params);
    });
  }
}
