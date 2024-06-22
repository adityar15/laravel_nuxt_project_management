import {
    CalendarIcon,
    ChartPieIcon,
    Cog6ToothIcon,
    DocumentDuplicateIcon,
    FolderIcon,
    HomeIcon,
    UsersIcon,
  } from '@heroicons/vue/24/outline'

export default function useSidebar()
{
    const sidebarOpen = useState('sidebar-open', ()=>false)

    const navigation = [
        { name: 'Dashboard', href: '/dashboard', icon: HomeIcon, current: true },
        { name: 'Projects', href: '/dashboard/projects', icon: FolderIcon, current: false },
        // { name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
        // { name: 'Documents', href: '#', icon: DocumentDuplicateIcon, current: false },
        // { name: 'Reports', href: '#', icon: ChartPieIcon, current: false },
      ]

    return {
        sidebarOpen,
        navigation
    }
}