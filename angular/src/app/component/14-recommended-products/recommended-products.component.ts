import { Component, OnInit } from '@angular/core';
import { Product } from 'src/app/interface/product';
import { ProductService } from 'src/app/service/product/product.service';

@Component({
  selector: 'app-recommended-products',
  templateUrl: './recommended-products.component.html',
  styleUrls: ['./recommended-products.component.css']
})
export class RecommendedProductsComponent implements OnInit {
  products: Product[] = []

  constructor(private productService:ProductService){}

  ngOnInit(): void {
      this.productService.getRecommended().subscribe((data:any)=>{this.products = data.data})
  }

}
