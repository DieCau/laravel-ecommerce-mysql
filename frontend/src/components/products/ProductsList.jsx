import { useState } from 'react';
import ProductsListItem from './ProductsListItem';

export default function ProductsList({ products }) {
  const [productsToShow, setProductsToShow] = useState(3)

  const loadMoreProducts = () => {
    if(productsToShow > products?.length) {
      return;
    }else {
      setProductsToShow(prevProductsToShow => prevProductsToShow += 3)
    }
  }

  return (
    <div className='row my-5'>
      {
        products?.slice(0, productsToShow).map((product => (
            <ProductsListItem key={ product.id } product={ product } />
          ))
        )
      }
      {
          productsToShow < products?.length &&
          <div className='d-flex justify-content-center my-3'>
              <button className='btn btn-sm btn-primary btn-dark' 
                onClick={ loadMoreProducts }
              >
                <i className='bi bi-arrow-clockwise'></i>{""} 
                Cargar mas
              </button>
            </div>
          || null
      }
    </div>
  )
}
