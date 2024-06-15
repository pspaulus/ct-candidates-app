import React from 'react';
import { createRoot } from 'react-dom/client';
import Index from './Index';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Tasks from './Pages/Tasks';

const container = document.getElementById('app');

const root = createRoot(container);

root.render(
    <React.StrictMode>
        <BrowserRouter>
            <Routes>
                <Route path='/' element={<Index />} />
                <Route path='/tasks' element={<Tasks />} />
            </Routes>
        </BrowserRouter>
    </React.StrictMode>
);
