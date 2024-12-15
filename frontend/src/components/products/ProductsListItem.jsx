import { Link } from 'react-router-dom'

export default function ProductsListItem({ product }) {
  return (
    <div className='col-md-4 mb-3'>
      <Link className='text-decoration-none text-dark'>
        <div className='card shadow-sm h-100'>
          <img src={ product.thumbnail } className='card-img-top' alt={ product.name } />
          <div className='card-body'>
            <div className='d-flex justify-content-between align-items-center'>
              <h5 className='fw-bold'>{ product.name }</h5>
              <h6 className='badge bg-success p-2'>${ product.price }</h6>
            </div>
            <div className='d-flex justify-content-between align-items-center'>
              <div className='d-flex justify-content-between align-items-center mt-2'>
                {
                  product.sizes?.map((size) => (
                    <span key={ size.id } className='bg-dark-subtle text-dark me-2 pe-1 ps-1 fw-bold'>
                      <small>{ size.name }</small>
                    </span>
                  ))
                }
              </div>
              <div>
                {
                  product.status == 1 ? 
                    <span className='badge bg-warning p-2'>En stock</span>
                  : 
                    <span className='badge bg-danger p-2'>Sin stock</span>
                }
              </div>
            </div>
          </div>
        </div>
      </Link>
    </div>
  )
}
