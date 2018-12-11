const routes = [
  {
    path: '/',
    redirect: () => {
      return { path: '/products/index' }
    }
  },
  {
    path: '/products',
    component: () => import('layouts/Main'),
    children: [
      {
        path: 'index',
        component: () => import('pages/products/Index')
      },
      {
        path: 'create',
        component: () => import('pages/products/Create')
      }
    ]
  },
  {
    path: '/products/:id',
    component: () => import('layouts/Main'),
    children: [
      {
        path: 'edit',
        component: () => import('pages/products/Edit')
      }
    ]
  }
]

// Always leave this as last one
if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('pages/Error404.vue')
  })
}

export default routes
