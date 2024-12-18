import { Link } from 'react-router-dom'
import { colorTranslations } from '../helpers/colorTranslations'

export default function ProductsListItem({ product }) {
  return (
    <div className='col-md-4 mb-3'>
      <Link to={ `/product/${product.slug}` } className='text-decoration-none text-dark'>
        <div className='card shadow-sm h-100'>
          <img src={ product.thumbnail } className='card-img-top' alt={ product.name } />
          <div className='card-body'>
            <div className='d-flex justify-content-between align-items-center'>
              <h5 className='fw-bold'>{ product.name }</h5>
              <h6 className='badge bg-success p-2'>${ product.price }</h6>
            </div>
            <div className='d-flex justify-content-between'>
              {/* Sizes */}
              <div className='d-flex justify-content-between align-items-center mt-2'>
                {
                  product.sizes?.map((size) => (
                    <span key={ size.id } className='bg-dark-subtle text-dark me-2 pe-1 ps-1 fw-bold'>
                      <small>{ size.name }</small>
                    </span>
                  ))
                }
              </div>
              {/* Status */}
              <div>
                {
                  product.status == 1 ? 
                    <span className='badge bg-warning p-2'>En stock</span>
                  : 
                    <span className='badge bg-danger p-2'>Sin stock</span>
                }
              </div>
            </div>

            {/* Colors */}
            <div className='d-flex justify-content-start align-items-center mt-2'>
              {
                product.colors?.map((color) => (
                  <div key={ color.id } className='me-1 border border-dark-subtle border-1'  
                    style={{ 
                      backgroundColor: colorTranslations[color.name.toLowerCase()] || 'transparent', 
                      width: '20px', 
                      height: '20px', 
                      borderRadius: '50%' 
                    }}>
                  </div>
                ))
              }
            </div>
          </div>
        </div>
      </Link>
    </div>
  )
}
