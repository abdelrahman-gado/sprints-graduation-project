import { Component,Input } from '@angular/core';
import { Product } from 'src/app/interface/product';
import { StorageService } from 'src/app/service/storage/storage.service';

@Component({
  selector: 'app-trending-product',
  templateUrl: './trending-product.component.html',
  styleUrls: ['./trending-product.component.css']
})
export class TrendingProductComponent {
  @Input() product: Product = {} as Product

  constructor(private storageService:StorageService){}

  addProductToCart(){
    this.storageService.addProducts(this.product, 1);
  }
}
