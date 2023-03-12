import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Product } from 'src/app/interface/product';
import { ProductService } from 'src/app/service/product/product.service';

@Component({
  selector: 'app-admin-product-show',
  templateUrl: './admin-product-show.component.html',
  styleUrls: ['./admin-product-show.component.css']
})
export class AdminProductShowComponent implements OnInit {
  product: Product = {} as Product
  id: number = 0
  constructor(private route:ActivatedRoute, private productService:ProductService){}

  ngOnInit(): void {
      this.route.params.subscribe(params=>this.id=params['id'])
      this.productService.getProductsById(this.id).subscribe((data:any)=>this.product = data)

  }

}
