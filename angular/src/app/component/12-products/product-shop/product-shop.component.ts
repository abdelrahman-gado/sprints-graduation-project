import { Component, Input } from '@angular/core';
import { Product } from 'src/app/interface/product';
import { StorageService } from 'src/app/service/storage/storage.service';

@Component({
  selector: 'app-product-shop',
  templateUrl: './product-shop.component.html',
  styleUrls: ['./product-shop.component.css'],
})
export class ProductShopComponent {
  @Input() product: Product = {} as Product;

  constructor(private storageService:StorageService){}

  addProductToCart(){
    this.storageService.addProducts(this.product, 1);
  }
}
