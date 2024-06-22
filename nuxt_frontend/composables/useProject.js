export default function useProject(){
    const project = useState('project', () => null)

    return {
        project
    }
}