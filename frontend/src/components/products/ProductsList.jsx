import React from 'react'
import ProductsListItem from './ProductsListItem'

export default function ProductsList({ products }) {
  return (
    <div className='row my-5'>
      {
        products?.map((product => (
            <ProductsListItem key={ product.id } product={ product } />
          ))
        )
      }
    </div>
  )
}
