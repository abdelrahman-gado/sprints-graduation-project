import { Component, OnInit } from '@angular/core';
import { Product } from 'src/app/interface/product';
import { ProductService } from 'src/app/service/product/product.service';

@Component({
  selector: 'app-trending',
  templateUrl: './trending.component.html',
  styleUrls: ['./trending.component.css']
})
export class TrendingComponent implements OnInit {
  products: Product[] = []

  constructor(private productService:ProductService){}
  
  ngOnInit(): void {
      this.productService.getTrending().subscribe((data:any)=>this.products = data.data)
    
    }
}
