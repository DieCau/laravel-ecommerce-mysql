import React from 'react'
import ProductsListItem from './ProductsListItem'

export default function ProductsList({ products }) {
  return (
    <div>
      {
        products?.map((product => (
            <ProductsListItem key={ product.id } product={ product } />
          ))
        )
      }
    </div>
  )
}
