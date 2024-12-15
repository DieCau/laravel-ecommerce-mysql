import React, { useEffect, useState } from 'react'
import { axiosRequest } from './helpers/config'
import ProductsList from './products/ProductsList'

export default function Home() {

  const [products, setProducts] = useState([])
  const [colors, setColors] = useState([])
  const [sizes, setSizes] = useState([])
  const [loading, setLoading] = useState(false)

  useEffect(() => {
    const fetchAllProducts = async () => {
      try {
        const response = await axiosRequest.get('products')
        setProducts(response.data.data)        
        setColors(response.data.colors)        
        setSizes(response.data.sizes)        
      } catch (error) {
        console.log(error)
      }
    }
    fetchAllProducts()  
  },[])
  
  return (
    <ProductsList products={products} />
  )
}
