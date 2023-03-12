import { Category } from "./category"
import { Color } from "./color"

export interface Product {
  id: number,
  name: string
  image: string,
   price: number,
  description: string,
  discount: number,
  category_id: number,
  color_id: number,
  color: Color,
  category: Category,
  reviews_count: number,
  reviews_avg_rating: number,

}
