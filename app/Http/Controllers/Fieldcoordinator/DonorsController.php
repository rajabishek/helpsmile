<?php 

namespace Helpsmile\Http\Controllers\Fieldcoordinator;

use Auth;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Helpsmile\Http\Controllers\Controller;
use Helpsmile\Repositories\DonorRepositoryInterface;
use Helpsmile\Services\Forms\DonorUpdateForm;
use Helpsmile\Services\Validation\FormValidationException;
use Helpsmile\Exceptions\DonorNotFoundException;

class DonorsController extends Controller{

    /**
     * Donor repository.
     *
     * @var \Helpsmile\Repositories\DonorRepositoryInterface
     */
    protected $donors;

    /**
     * Create a new UsersController instance.
     *
     * @param  \Helpsmile\Repositories\DonorRepositoryInterface $donors
     * @return void
     */
    public function __construct(DonorRepositoryInterface $donors)
    {
        $this->donors = $donors;
    }

    /**
	 * Display a listing of the resource.
	 * GET /teamleader/donors
	 *
	 * @return Response
	 */
	public function index($domain, Request $request)
	{
        $term = e($request->get('q'));
        $organisation = $request->user()->organisation;
       
        if($term)
        {
        	$message = "Coudn't find any donors matching the term $term for you. We suggest you to go back and search for another term once more.";
            $donors = $this->donors->searchByTermForOrganisation($term, $organisation);
        	return view('fieldcoordinator.donors.index',compact('domain','donors','message','term'));
        }
        else
        {
            $donors = $this->donors->findAllPaginatedForOrganisation($organisation);
            $message = "You haven't added any donor's details, we suggest you to add one !";
            return view('fieldcoordinator.donors.index',compact('domain','donors','message'));
        }
	}

	/**
	 * Display the specified resource.
	 * GET /teamleader/donors/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($domain, $id)
	{
        try
        {
            $donor = $this->donors->findByIdForOrganisation($id, Auth::user()->organisation);
            return view('fieldcoordinator.donors.show',compact('domain','donor'));

        }
        catch(DonorNotFoundException $e)
        {
            $backLink = route('fieldcoordinator.donors.index',$domain);
            return view('errors.donornotfound',compact('domain','backLink'));
        }
	}

    /**
     * Update the specified resource in storage.
     * PUT /teamleader/donors/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($domain, $id, DonorUpdateForm $form, Request $request)
    {   
        $input = $request->all();
        $input['id'] = $id;

        try
        {
            $form->validate($input);
            $donor = $this->donors->findByIdForOrganisation($id,$request->user()->organisation);
            $donor = $this->donors->edit($donor,$input);

            if($request->ajax())
                    return response()->json(['sucess' => true, 'donor' => $donor]);

            flash()->success('You have successfully change the donor details.');
            return redirect()->route('teamleader.donors.show',[$domain,$donor->id]);
        }
        catch (FormValidationException $e){

            if($request->ajax())
                return response()->json(['success' => false,'errors' => $e->getErrors()->all()]);

            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /teamleader/donors/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($domain, $id)
    { 
        $donor = $this->donors->findByIdForOrganisation($id, Auth::user()->organisation);
        $donor->delete();

        flash()->success("You have successfully removed the donor.");
        return redirect()->route('fieldcoordinator.donors.index',$domain);
    }
}
